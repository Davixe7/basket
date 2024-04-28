<template>
    <div class="flex timer">
        <div>
            {{ quarter.label }}
            <q-menu fit auto-close>
                <q-list style="min-width: 100px">
                    <q-item v-for="qtr in quarters" clickable @click="setQuarter(qtr.index)">
                        <q-item-section>{{qtr.label}}</q-item-section>
                    </q-item>
                </q-list>
            </q-menu>
        </div>
        <div v-ripple @click="isPaused = !isPaused">{{time}}</div>
        <div v-ripple @click="shotClock=24">:{{ String(shotClock).padStart(2, '0') }}</div>
    </div>
    <q-separator></q-separator>

    <div
        v-ripple
        style="text-align: center; padding: .05rem; position: relative;"
        @click="timeout.isPaused = !timeout.isPaused"
        class="flex justify-center timeout">
        {{ timeoutClock }}
    </div>

    <q-separator></q-separator>

    <div class="scoreboard">
        <div>
            <div style="font-size: 1rem;">
                Las Villas BBC
            </div>
            <div class="q-ml-auto flex items-center">
                <div style="font-size: .8rem; margin-right: .25rem;">{{ String(fouls).padStart(2,'0') }}</div>
                {{ String(score).padStart(2, '0') }}
            </div>
        </div>
        <q-separator></q-separator>
        <div @click="opponentScore++">
            <div style="font-size: 1rem;">
                Space Jam 4.0
            </div>
            <div class="q-ml-auto">
                {{ String(opponentScore).padStart(2,'0') }}
            </div>
        </div>
    </div>

    <q-separator/>

    <q-table
        flat
        hide-bottom
        :rows="rows"
        :columns="columns">
        <template v-slot:body-cell-avatar="props">
            <q-td style="padding-right: 0;">
                <q-avatar size="40px">
                    <img v-if="props.row.fouls.length < 5" :src="`https://cdn.quasar.dev/img/avatar6.jpg`">
                    <q-icon v-else v-ripple name="sym_o_sync"></q-icon>
                </q-avatar>
            </q-td>
        </template>
        <template v-slot:body-cell-name="props">
            <q-td class="q-pl-none">
                <div caption>
                    #{{ props.row.number }} | {{ positions[props.row.position - 1] }}
                </div>
                <div>
                    {{ props.row.name }}
                </div>
            </q-td>
        </template>
        <template v-for="n in 3" v-slot:[`body-cell-${n}`]="props">
            <q-td v-ripple class="text-center" @click="addPoints(props.row, n)">
                {{ props.row[n] }}
            </q-td>
        </template>
        <template v-slot:body-cell-fouls="props">
            <q-td v-ripple>
                <span @click="addFoul(props.row)" :class="{'text-red': props.row.fouls.length >= 5}">
                    {{ props.row.fouls.length }}
                </span>
            </q-td>
        </template>
    </q-table>

    <q-list separator v-show="false">
    <q-item v-for="player in rows" :key="player.id">
        <q-item-section avatar>

          <q-avatar>
            <img v-if="player.fouls.length < 5" :src="`https://cdn.quasar.dev/img/avatar6.jpg`">
            <q-icon v-else v-ripple name="sym_o_sync"></q-icon>
          </q-avatar>

        </q-item-section>

        <q-item-section>
          <q-item-label caption>#{{ player.number }} | {{ positions[player.position - 1] }}</q-item-label>
          <q-item-label  lines="1">{{ player.name }}</q-item-label>
        </q-item-section>

        <q-item-section side>
            <q-btn-group dense round>
                <q-btn
                    outline
                    v-for="n in 3"
                    @click="addPoints(player, n)">
                    {{ player[n] }}
                </q-btn>
                <q-btn
                    outline
                    @click="addFoul(player)">
                    {{ player.fouls.length }}
                </q-btn>
            </q-btn-group>
        </q-item-section>
      </q-item>
    </q-list>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue'
const props = defineProps(['players'])

const columns = [
    {name: 'avatar', align: 'left', sortable: false},
    {name: 'name', align: 'left', sortable: false},
    {name: '1', label: 'TL', align: 'center', sortable: false},
    {name: '2', label: 'T2', align: 'center', sortable: false},
    {name: '3', label: 'T3', align: 'center', sortable: false},
    {name: 'fouls', label: 'FP', field: row => row.fouls.length, align: 'center', sortable: true},
]

const positions = ['Piloto','Escolta','Alero','Ala Pivot','Pivot']
const rows      = ref([])
const score     = computed(()=>{
    return rows.value.reduce((prev, curr)=> prev + curr['1'] + (curr['2'] * 2) + (curr['3'] * 3), 0)
})
const opponentScore = ref(0)
function addPoints(player, points){
    player[points]++
}

const fouls = computed(() => rows.value.reduce((prev, player) => {
    let currentQuarterFouls = player.fouls.filter(foul => foul == quarter.value.index).length
    return( prev >= 5 ) ? 5 : prev + currentQuarterFouls
},0))

function addFoul(player){
    if( player.fouls.length == 5){ return }
    player.fouls.push(quarter.value.index)
}

const quarters  = ref([
    {label:'1st', index: 0},
    {label:'2nd', index: 1},
    {label:'3rd', index: 2},
    {label:'4th', index: 3}
])
const quarter   = ref(quarters.value[0])
const seconds   = ref(600)
const shotClock = ref(24)
const isPaused  = ref(false)
const time = computed(()=>{
    let minutes = String(Math.floor(seconds.value / 60)).padStart(2,'0')
    let secs    = String(seconds.value % 60).padStart(2, '0')
    return minutes + ':' + secs;
})

const timeout = ref({
    isPaused: true,
    remaining: 180
})
const timeoutClock = computed(()=>{
    let mins = String( Math.floor(timeout.value.remaining / 60) ).padStart(2, '0')
    let secs = String( timeout.value.remaining % 60 ).padStart(2, '0')
    return `${mins}:${secs}`
})

function setQuarter(qtrIndex){
    quarter.value   = quarters.value[qtrIndex]
    isPaused.value  = true
    seconds.value   = 600
    shotClock.value = 24
}

onMounted(()=>{
    rows.value = [...props.players].map(player => ({
        ...player,
        1: 0,
        2: 0,
        3: 0,
        fouls: []
    }))

    setInterval(()=>{
        if(timeout.value.isPaused || timeout.value.remaining == 0) return
        timeout.value.remaining--
    }, 1000)
    setInterval(() => {
       if(isPaused.value) return
       if( seconds.value > 0 ){
        seconds.value--
       }
       if( shotClock.value > 0 ){
        shotClock.value--
       }else {
        shotClock.value = 24
       }
    }, 1000);
})
</script>

<style lang="scss">
.scoreboard > div {
    font-size: 2rem;
    font-weight: 500;
    height: 50px;
    padding: 0 1rem;
    flex: 1 1 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.timer {
    height: 50px;
}
.timer > div {
    position: relative;
    flex: 1 1 33%;
    display: flex;
    align-items: center;
    justify-content: center;
    &:first-child {
        font-size: 1.5rem;
    }
    &:nth-child(2){
        font-size: 1.25rem;
    }
    &:nth-child(3){
        font-size: 1.25rem;
    }
}
</style>
