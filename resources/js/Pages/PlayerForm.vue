<template>
    <div class="q-gutter-y-md q-pa-md">
        <div class="bg-white flex q-pr-md">
            <q-img src="/img/profile.png" width="125px"></q-img>
            <div class="flex justify-center items-center q-ml-auto"
                style="font-weight: 700; font-size: 6rem; -webkit-text-stroke: 1px #000; letter-spacing: -.25rem;">
                {{ form.number ? form.number : '' }}
            </div>
        </div>

        <q-input
            outlined
            stack-label
            v-model="form.name"
            label="Nombre y Apellido"
        />

        <q-select
            outlined
            stack-label
            v-model="form.position"
            label="Posición"
            :options="positions">
        </q-select>

        <q-input
            outlined
            stack-label
            v-model="form.number"
            label="Número de camiseta"
            type="number"
        />

        <q-input outlined stack-label v-model="form.weight" label="Estatura">
            <template v-slot:append="props">
                <span style="font-size: .9rem;">
                    mts
                </span>
            </template>
        </q-input>

        <q-input outlined stack-label v-model="form.height" label="Peso">
            <template v-slot:append="props">
                <span style="font-size: .9rem;">
                    kgs
                </span>
            </template></q-input>

        <div class="flex justify-end">
            <q-btn
                flat
                :loading="form.processing"
                @click="save">
                Guardar
            </q-btn>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
const form = useForm({ name: '', number: null, position: null })
const positions = ref([
    { label: 'Piloto', value: 1 },
    { label: 'Escolta', value: 2 },
    { label: 'Alero', value: 3 },
    { label: 'Ala pivot', value: 4 },
    { label: 'Pivot', value: 5 },
])

function save(){
    form.post('/players')
}
</script>
