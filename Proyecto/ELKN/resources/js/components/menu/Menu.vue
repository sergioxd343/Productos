<template>
  <!-- Drawer lateral -->
  <v-navigation-drawer v-model="drawer" :permanent="$vuetify.display.mdAndUp" :temporary="$vuetify.display.smAndDown"
    color="#027368" expand-on-hover rail app>
    <v-list>
      <Link href="/usuarios/profile">
      <v-hover v-slot="{ isHovering, props }">
        <v-list-item v-bind="props" :prepend-avatar="pirmaLogo" :subtitle="user.usuario" :title="user.nombre" :style="{
          fontSize: '1.2rem',
          fontWeight: 600,
          color: isHovering ? 'black' : 'white',
          backgroundColor: isHovering ? '#F2F2F2' : 'transparent',
          transform: isHovering ? 'translateX(5px)' : 'none',
          transition: 'all 0.3s ease'
        }" />
      </v-hover>
      </Link>
    </v-list>

    <v-divider :thickness="10" color="white"></v-divider>

    <v-list density="compact" nav>

      <!-- Dashboard -->
      <Link href="/dashboard">
      <v-hover v-slot="{ isHovering, props }">
        <v-list-item v-bind="props" prepend-icon="mdi-view-dashboard" title="Dashboard" :style="{
          fontSize: '1.2rem',
          fontWeight: 600,
          color: isHovering ? 'black' : 'white',
          backgroundColor: isHovering ? 'white' : 'transparent',
          transform: isHovering ? 'translateX(5px)' : 'none',
          transition: 'all 0.3s ease'
        }" />
      </v-hover>
      </Link>

      <v-divider :thickness="1" color="white" inset></v-divider>

      <!-- ✅ GRUPO: RELACIONES LABORALES -->
      <v-list-group value="relacionesLaborales" expand-icon="mdi-chevron-down" collapse-icon="mdi-chevron-up"
        transition="expand-transition">
        <template #activator="{ props }">
          <v-list-item v-bind="props" title="Relaciones laborales" prepend-icon="mdi-briefcase-account"
            style="font-size:1.2rem; font-weight:700; color:white" />
        </template>

        <v-expand-transition>
          <div>
            <!-- Sub-opción: Accidentes -->
            <Link href="/accidentes">
            <v-hover v-slot="{ isHovering, props }">
              <v-list-item v-bind="props" prepend-icon="mdi-alert" title="Accidentes" :style="{
                fontSize: '1rem',
                color: isHovering ? 'black' : 'white',
                backgroundColor: isHovering ? '#F2F2F2' : 'transparent',
                transform: isHovering ? 'translateX(5px)' : 'none',
                transition: 'all 0.3s ease'
              }" />
            </v-hover>
            </Link>

            <!-- Sub-opción: Seguimiento -->
            <Link href="/seguimiento">
            <v-hover v-slot="{ isHovering, props }">
              <v-list-item v-bind="props" prepend-icon="mdi-timeline-check" title="Seguimiento" :style="{
                fontSize: '1rem',
                color: isHovering ? 'black' : 'white',
                backgroundColor: isHovering ? '#F2F2F2' : 'transparent',
                transform: isHovering ? 'translateX(5px)' : 'none',
                transition: 'all 0.3s ease'
              }" />
            </v-hover>
            </Link>
          </div>
        </v-expand-transition>
      </v-list-group>


    </v-list>
  </v-navigation-drawer>

  <!-- Barra superior -->
  <v-app-bar app dense flat color="#027368" clipped-left>
    <v-app-bar-nav-icon @click="drawer = !drawer" />
    <v-toolbar-title>{{ currentModule }}</v-toolbar-title>

    <v-spacer />



    <v-menu>
      <template #activator="{ props }">
        <!-- Notificaciones -->
        <v-badge v-bind="props" v-if="notificaciones > 0" :content="notificaciones" color="red" offset-x="10"
          offset-y="10">
          <v-btn icon class="mr-4">
            <v-icon>mdi-bell</v-icon>
          </v-btn>
        </v-badge>

        <v-btn v-bind="props" v-else icon class="mr-4">
          <v-icon>mdi-bell</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-table :style="{ width: '100%', maxHeight: '500px', overflowY: 'auto' }" fixed-header>
          <thead>
            <tr v-if="notificaciones === 0">
              <th class="text-left">No hay notificaciones</th>
            </tr>
            <tr v-else>
              <th class="text-left">Tienes nuevas notificaciones</th>
            </tr>
          </thead>
          <tbody>

            <!-- <tr v-for="i in accidentesEnCierre" :key="i.id">
              <td class="text-left">
                Accidente ID #{{ i.id }} en {{ i.departamento.nombre }} sin cierre.
              </td>
            </tr> -->
            <!-- Notificaciones  de planes de accion fecha implementacion sin validar-->
            <tr v-for="j in accidentesSinValidarFecha" :key="j.id">
              <td class="text-left">
                Accidente ID #{{ j.id }} en <span
                  style="font-weight:700; background-color:#FFD54F; color:#000; padding:2px 6px; border-radius:4px;">{{
                    j.departamento.nombre }}</span> con plan de acción sin fecha validada.
              </td>
            </tr>
            <!-- Notificaciones  de planes de accion implementados pero no validados-->
            <tr v-for="k in accidentesSinValidarYImplementados" :key="k.id">
              <td class="text-left">
                Accidente ID #{{ k.id }} en <span
                  style="font-weight:700; background-color:#FF8A65; color:#000; padding:2px 6px; border-radius:4px;">{{
                    k.departamento.nombre }}</span> con plan de acción implementado pero no validado.
              </td>
            </tr>
            <!-- Notificaciones  de planes de accion proximos a vencer-->
            <tr v-for="l in planesAccionesProximosAVencer" :key="l.id">
              <td class="text-left">
                Accidente ID #{{ l.id }} en <span
                  style="font-weight:700; background-color:#FFB74D; color:#000; padding:2px 6px; border-radius:4px;">{{
                    l.departamento.nombre }}</span> con plan de acción próximo a vencer.
              </td>
            </tr>
            <!-- Notificaciones  de planes de accion vencidos-->
            <tr v-for="m in planesAccionesVencidos" :key="m.id">
              <td class="text-left">
                Accidente ID #{{ m.id }} en <span
                  style="font-weight:700; background-color:#E57373; color:#000; padding:2px 6px; border-radius:4px;">{{
                    m.departamento.nombre }}</span> con plan de acción vencido.
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card>
    </v-menu>

    <!-- <div class="ml-4 text-caption pr-5">Último inicio: {{ lastLogin }}</div> -->

    <!-- 🔽 Menú de usuario -->
    <v-menu>
      <template #activator="{ props }">
        <v-btn v-bind="props" icon>
          <v-icon>mdi-account-circle</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item @click="irPerfil">
          <v-list-item-title>Perfil</v-list-item-title>
        </v-list-item>

        <v-list-item @click="cerrarSesion">
          <v-list-item-title>Cerrar sesión</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import pirmaLogo from '/public/logos/pirmaamarillo.png'
import axios from 'axios'

defineProps<{
  currentModule: string
}>()

const drawer = ref(true)
const lastLogin = ref('No disponible')
const idrol = ref<string>('')

const user = JSON.parse(localStorage.getItem('user') || '{}')

const notificaciones = ref(0)
const accidentesSinValidarFecha = ref<any[]>([])
const accidentesSinValidarYImplementados = ref<any[]>([])
const planesAccionesProximosAVencer = ref<any[]>([])
const planesAccionesVencidos = ref<any[]>([])

if (user && user.last_access) {
  const date = new Date(user.last_access)
  lastLogin.value = date.toLocaleDateString() + ' ' + date.toLocaleTimeString()
  idrol.value = user.idrol
}

function irPerfil() {
  router.visit('/usuarios/profile')
}


const fnLogout = async () => {
  try {
    // 🔹 Asegurarse de enviar cookies y CSRF
    await axios.post('/web/logout', {}, {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      withCredentials: true // Muy importante para enviar la sesión de Laravel
    });

    // 🔹 Limpiar localStorage
    localStorage.removeItem('user');
    localStorage.removeItem('api_token');

    // 🔹 Redirigir con Inertia
    router.visit('/login', {
      method: 'get',
      preserveState: false, // Asegura que la página se recargue sin mantener estado viejo
      preserveScroll: true
    });
  } catch (error) {
    if (typeof error === 'object' && error !== null) {
      const err = error as any;
      console.error('Error al cerrar sesión:', err.response?.data?.message || err.message);
    } else {
      console.error('Error al cerrar sesión:', error);
    }
    // Opcional: mostrar toast o alerta al usuario
  }
};




function cerrarSesion() {
  fnLogout()
}

onMounted(() => {
  // fnGetAccidentes()
})

</script>
