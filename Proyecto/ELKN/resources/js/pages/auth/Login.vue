<template>
    <v-col cols="12" class="d-flex" style="background-color: aliceblue; min-height: 100vh">
        <v-container class="fill-height d-flex align-center justify-center">
            <v-row class="w-100" align="center" justify="center">
                <!-- Imagen a la izquierda: solo visible en md+ -->
                <!-- <v-col cols="0" md="6" class="d-none d-md-flex justify-center">
                    <v-img src="/resources/bg/bg-right.jpg" alt="Imagen Seguridad Industrial" contain
                        class="bg-image" />
                </v-col> -->

                <!-- Formulario -->
                <v-col cols="12" sm="10" md="6" lg="6" xl="4">
                    <v-card elevation="12" class="pa-6 rounded-lg">
                        <v-toolbar dark color="primary" flat class="mb-4 rounded-t-lg">
                            <v-toolbar-title class="text-h6">BASE</v-toolbar-title>
                        </v-toolbar>

                        <v-card-title class="text-h5 justify-center">TITULO BASE
                        </v-card-title>
                        <!-- <v-img src="/logos/logo.png" alt="Logo" class="my-4" height="150" contain /> -->
                        <v-divider class="my-2"></v-divider>
                        <v-card-subtitle class="text-h6 mb-4">Iniciar Sesión</v-card-subtitle>

                        <v-form ref="loginForm" v-model="valid" lazy-validation class="mt-5">
                            <v-text-field
                                v-model="username"
                                variant="outlined"
                                label="Usuario"
                                prepend-icon="mdi-account"
                                clearable
                                :rules="[(v) => !!v || 'El usuario es requerido']"
                                required
                                outlined
                                dense
                            />

                            <v-text-field
                                v-model="password"
                                variant="outlined"
                                label="Contraseña"
                                prepend-icon="mdi-lock"
                                :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                clearable
                                :rules="[(v) => !!v || 'La contraseña es requerida']"
                                required
                                outlined
                                dense
                            />

                            <v-btn color="primary" size="x-large" class="mt-5" block :disabled="!valid" @click="submit"> Ingresar </v-btn>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-col>
</template>

<script setup lang="ts">
import axios from 'axios';
import Swal from 'sweetalert2';
import { onMounted, ref } from 'vue';
import type { VForm } from 'vuetify/components';

const username = ref('');
const password = ref('');

const valid = ref(false);
const showPassword = ref(false);
const loginForm = ref<VForm | null>(null);

const submit = async () => {
    if (loginForm.value) {
        const { valid: isValid } = await loginForm.value.validate();
        if (isValid) {
            try {
                Swal.fire({
                    title: 'Iniciando sesión...',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                });

                const response = await axios.post('/web/login', {
                    login: username.value,
                    password: password.value,
                });

                console.log('Respuesta del servidor:', response.data);

                // Guardar el token en el almacenamiento local o en una cookie si es necesario
                const token = response.data.token;
                localStorage.setItem('api-token', token);

                localStorage.setItem('user', response.data.user ? JSON.stringify(response.data.user) : '{}');

                Swal.fire({
                    icon: 'success',
                    title: '¡Bienvenido!',
                    text: response.data.message || 'Inicio de sesión exitoso',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    window.location.href = '/dashboard'; // Redirigir al dashboard
                });
            } catch (error: any) {
                if (error.response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de autenticación',
                        text: error.response.data.message || 'Usuario o contraseña incorrectos',
                    });
                } else {
                    console.error('Error de conexión:', error.message);
                }
            } finally {
                setTimeout(() => {
                    Swal.close();
                }, 1500);
                loginForm.value?.reset();
            }
        }
    }
};

onMounted(() => {});
</script>

<style scoped>
.v-card {
    padding: 24px;
}

.rounded-lg {
    border-radius: 12px;
}

.bg-image {
    background-size: cover;
    background-position: center;
    max-width: 80%;
    height: auto;
}
</style>
