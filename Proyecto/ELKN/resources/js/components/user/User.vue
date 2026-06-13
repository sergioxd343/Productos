<template>
    <v-container>

        <v-card>
            <v-card-title>
                USUARIO
                <v-spacer :thickness="5"></v-spacer>

            </v-card-title>

            <v-card-text>
                <div class="text-h6 mb-4">Detalles del usuario</div>
                <v-form>
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field label="Usuario" v-model="editedItem.usuario" variant="outlined" dense
                                disabled />
                        </v-col>
                        <v-col cols="12" md="6">
                            
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field label="Nombre" v-model="editedItem.nombre" variant="outlined" dense />
                        </v-col>
                        <v-divider class="my-4"></v-divider>
                        <!-- Contraseña nueva -->
                        <v-col cols="12" md="6">
                            <v-text-field label="Contraseña nueva"
                                :rules="[rules.required, rules.min, rules.max, rules.upper, rules.lower, rules.number, rules.strongPassword]"
                                v-model="editedItem.password" variant="outlined" dense type="password" />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field label="Confirmar contraseña" :rules="[rules.required, rules.passwordMatch]"
                                v-model="confirmarPassword" variant="outlined" dense type="password" />
                        </v-col>
                        <v-col cols="12" class="d-flex justify-end">
                            <v-btn color="primary" @click="fnOpenDialogConfirmar" :disabled="!btnactive">Guardar
                                cambios</v-btn>
                        </v-col>
                    </v-row>
                </v-form>

            </v-card-text>

        </v-card>


        <!-- Dialog confirmar contraseña -->
        <v-dialog v-model="dialogConfirmar" max-width="600">
            <v-card>
                <v-card-title class="headline">Confirmar contraseña</v-card-title>
                <v-card-text>
                    <v-form ref="formConfirmar">
                        <v-text-field hint="Ingrese su contraseña actual" persistent-hint label="Contraseña"
                            v-model="passwordConfirmar" type="password" :rules="[rules.required]" variant="outlined"
                            dense />
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn text @click="dialogConfirmar = false">Cancelar</v-btn>
                    <v-btn color="primary" @click="fnGuardarCambios">Confirmar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- SNACKBAR GENERAL -->
        <v-snackbar v-model="alertaVisible" :color="alertaColor" timeout="2000" variant="elevated" top right>
            <template #default>
                <span>{{ alertaMensaje }}</span>
            </template>
        </v-snackbar>

    </v-container>

</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

interface User {
    id: number;
    usuario: string;
    nombre: string;
    password: string;
}

interface Role {
    id: number;
    nombre: string;
}

export default defineComponent({
    setup() {
        const btnactive = ref(false);
        const dialogConfirmar = ref(false);

        const item = ref<User[]>([]);
        const editedItem = ref<User>({
            id: 0,
            usuario: '',
            nombre: '',
            password: ''
        });

        const confirmarPassword = ref<string>('');
        const passwordConfirmar = ref<string>('');

        const roles = ref<Role[]>([]);

        const rules = {
            required: (value: string) => !!value || 'Este campo es obligatorio.',
            passwordMatch: (value: string) => value === editedItem.value.password || 'Las contraseñas no coinciden.',
            min: (value: string) => value.length >= 8 || 'Min 8 characters',
            max: (value: string) => value.length <= 20 || 'Max 20 characters',
            caracteres: (value: string) => /^[A-Za-z0-9]+$/.test(value) || 'Solo se permiten letras y números.',
            special: (value: string) => /[!@#$%^&*(),.?":{}|<>]/.test(value) || 'Debe incluir al menos un carácter especial.',
            upper: (value: string) => /[A-Z]/.test(value) || 'Debe incluir al menos una letra mayúscula.',
            lower: (value: string) => /[a-z]/.test(value) || 'Debe incluir al menos una letra minúscula.',
            number: (value: string) => /[0-9]/.test(value) || 'Debe incluir al menos un número.',
            strongPassword: (value: string) => {
                const conditions = [
                    /[A-Z]/.test(value),
                    /[a-z]/.test(value),
                    /[0-9]/.test(value),
                    /[!@#$%^&*(),.?":{}|<>]/.test(value)
                ];
                const metConditions = conditions.filter(Boolean).length;
                return metConditions >= 3 || 'La contraseña debe cumplir al menos 3 de las 4 condiciones: mayúscula, minúscula, número, carácter especial.';
            }
        };

        const fnGetUser = async () => {
            try {
                const response = await axios.get('/api/me',
                    {
                        headers: {
                            Accept: 'application/json',
                            Authorization: `Bearer ${localStorage.getItem('api-token')}`
                        }
                    }
                );
                // Asignar los datos del usuario a editedItem
                editedItem.value = response.data;

            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        };

        const fnOpenDialogConfirmar = () => {
            dialogConfirmar.value = true;
        };

        const fnGuardarCambios = async () => {
            try {
                const jsonData = {
                    current_password: passwordConfirmar.value,
                    new_password: editedItem.value.password,
                    new_password_confirmation: confirmarPassword.value,
                    nombre: editedItem.value.nombre
                };
                // Aquí puedes agregar lógica adicional si es necesario
                const response = await axios.post(`/api/usuarios/${editedItem.value.id}/change-password`, jsonData,
                    {
                        headers: {
                            Accept: 'application/json',
                            Authorization: `Bearer ${localStorage.getItem('api-token')}`
                        }
                    }
                );

                // Modificar el localStorage si el usuario ha cambiado su nombre: {"name":"ADMINISTRADOR","last_access":"2025-10-08T17:00:34.592407Z","login":"admin","idcia":1}
                if (editedItem.value.nombre !== item.value[0]?.nombre) {
                    const user = { "name": response.data.nombre, "last_access": response.data.ultimo_acceso, "login": response.data.login, "idcia": response.data.idcia, "idrol": response.data.idrol };
                    localStorage.setItem('user', JSON.stringify(user));
                }
                dialogConfirmar.value = false;
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Los cambios se han guardado correctamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {


                    // refrescar la página para que se apliquen los cambios
                    window.location.reload();
                });

            } catch (error) {
                dialogConfirmar.value = false;

                const errorMessage =
                    (error as any)?.response?.data?.message || 'Ocurrió un error al guardar los cambios.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    // Limpiar el campo de contraseña actual después de mostrar el error
                    passwordConfirmar.value = '';
                    dialogConfirmar.value = true;
                });
                console.error('Error al guardar cambios:', error);
            }
        };

        watch([() => editedItem.value.password, () => confirmarPassword.value], () => {
            const password = editedItem.value.password || '';
            const confirm = confirmarPassword.value || '';

            btnactive.value =
                password.length > 0 &&
                confirm.length > 0 &&
                rules.passwordMatch(confirm) === true;
        });

        onMounted(() => {
            fnGetUser();
        });
        return {
            item,
            editedItem,
            confirmarPassword,
            passwordConfirmar,
            rules,
            roles,
            btnactive,
            dialogConfirmar,
            fnOpenDialogConfirmar,
            fnGuardarCambios,
        };
    },
});
</script>
