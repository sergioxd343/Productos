<template>
  <v-app class="d-flex flex-column" style="min-height: 100vh;">
    <!-- Drawer + AppBar del hijo -->
    <Menu :current-module="currentModule"></Menu>

    <!-- Contenido principal -->
    <v-main class="flex-grow-1 pa-5" style="background-color: #F2F2F2;">
      <v-container fluid>
        <v-row justify="center">
          <v-col cols="12" md="10" lg="11">
            <h2 class="mb-5 mt-5 text-center text-md-left">
              <v-spacer></v-spacer>.
            </h2>

            <v-card class="pa-5" elevation="3">
              <User />
            </v-card>
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
import User from '@/components/user/User.vue'
import Footer from '@/components/footer/Footer.vue'

const currentModule = ref('Usuario')
</script>
