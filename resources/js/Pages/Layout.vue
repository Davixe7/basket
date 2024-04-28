<template>
    <q-layout view="hHh lpR fFf">

      <q-header class="bg-dark text-white" height-hint="98">
        <q-toolbar>
          <q-btn dense flat round icon="sym_o_menu" @click="toggleLeftDrawer" />

          <q-toolbar-title>

          </q-toolbar-title>
        </q-toolbar>

        <q-tabs align="left" v-model="tab">
          <q-tab name="game" to="/" label="Juego" />
          <q-tab name="roster" label="Roster" />
          <q-tab name="notes" label="Notas" />
        </q-tabs>
      </q-header>

      <q-drawer show-if-above v-model="leftDrawerOpen" side="left">
        <!-- drawer content -->
      </q-drawer>

      <q-page-container>
        <slot></slot>
      </q-page-container>

    </q-layout>
  </template>

  <script setup>
  import { ref } from 'vue'

  const tab = ref('game')
  const leftDrawerOpen = ref(false)
  function toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
  }
  </script>
