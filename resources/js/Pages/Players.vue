<template>
    <div class="text-caption q-mb-md">Jugadores</div>
    <q-table
        flat
        hide-pagination
        :pagination="{rowsPerPage: 0}"
        :columns="columns"
        :rows="rows">
        <template v-slot:body-cell-avatar="props">
            <q-td>
                <q-avatar v-if="!props.row.avatar" size="35px" color="primary" text-color="white">{{ props.row.name[0] }}</q-avatar>
                <q-avatar v-else color="primary" text-color="white">
                    <img src="https://cdn.quasar.dev/img/avatar.png">
                </q-avatar>
            </q-td>
        </template>
    </q-table>
</template>

<script setup>
import {ref, onMounted} from 'vue'
const props = defineProps(['players'])
const columns = ref([
    {name: 'avatar', label: '', sortable: false, align: 'left'},
    {name: 'number', label: 'NUM', field: 'number', sortable: true, align: 'left'},
    {name: 'name', label: 'JUGADOR', field: 'name', sortable: true, align: 'left'},
    {name: 'position', label: 'POS', field: 'position', sortable: true, align: 'left'},
])
const rows = ref()

onMounted(()=>rows.value = [...props.players])
</script>
