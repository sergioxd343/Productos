<template>
  <v-app class="d-flex flex-column" style="min-height: 100vh;">
    <!-- Drawer + AppBar -->
    <Menu :current-module="currentModule" ></Menu>

    <!-- Contenido principal -->
    <v-main class="flex-grow-1 pa-5" style="background-color: #F2F2F2;">
      <v-container fluid>
        <v-row justify="center">
          <v-col cols="12" md="12" lg="12">
            
          </v-col>
        </v-row>
      </v-container>
    </v-main>

    <Footer></Footer>
  </v-app>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import Menu from '@/components/menu/Menu.vue'
import Footer from '@/components/footer/Footer.vue'

// Componentes

const currentModule = ref('Dashboard')


document.title = 'Dashboard'
</script>

<style scoped>
.vue-grid-item > .v-card {
  transition: all 0.2s ease;
}
</style>
