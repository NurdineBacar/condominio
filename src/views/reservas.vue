<template>
  <div class="row">
    <div class="col-md-8">
      <div class="col-md-12">
        <div class="d-flex gap-2">
          <item
            icon="fa-brands fa-slack"
            evento="Todas"
            value="todas"
            v-model:selected="selectedFilter"
          />
          <item
            icon="fa-solid fa-home"
            evento="Desta Semana"
            value="semana"
            v-model:selected="selectedFilter"
          />
          <item
            icon="fa-solid fa-home"
            evento="Este Mês"
            value="mes"
            v-model:selected="selectedFilter"
          />
        </div>
        <div class="col-md-12 mt-3">
          <list
            :reservs="search.length > 0 ? searcFiltre : filteredReservations"
          />
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="row">
        <div class="col-md-12 mt-2">
          <div class="d-flex gap-2">
            <button
              class="btn btn-outline-success fw-semibold"
              data-bs-toggle="modal"
              data-bs-target="#reservationModal"
            >
              <i class="fa-solid fa-plus"></i> Nova
            </button>
            <inputs
              icon="fa-solid fa-magnifying-glass"
              input-type="search"
              p-holder="Procurar Reserva"
              v-model="search"
            />
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <!-- <calendar/> -->
        </div>
        <div class="col-md-12 mt-2">
          <div class="dash rounded pt-3 pb-2 px-1 mt-2">
            <div class="col-md-12 px-3 mb-1">
              <h5><i class="fa-solid fa-calendar-plus"></i> Total Reservas</h5>
              <p class="fs-6 fw-semibold amount">
                Quantidade: {{ totalReservations }}
              </p>
            </div>
            <div class="col-md-12 px-3 mb-1">
              <h5>
                <i class="fa-solid fa-triangle-exclamation"></i> Reservas desta
                semana
              </h5>
              <p class="fs-6 fw-semibold amount">
                Quantidade: {{ reservationsThisWeek }}
              </p>
            </div>
            <div class="col-md-12 px-3 mb-1">
              <h5>
                <i class="fa-regular fa-file-lines"></i> Reservas deste mês
              </h5>
              <p class="fs-6 fw-semibold amount">
                Quantidade: {{ reservationsThisMonth }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <rModal />
  </div>
</template>

<script setup>
import item from "../components/cItem.vue";
import list from "../components/tableReservation.vue";
import inputs from "../components/inputs.vue";
import rModal from "../components/reservationModal.vue";
import calendar from "../components/calendar.vue";
import { useRouter } from "vue-router";
const router = useRouter();

import { ref, onMounted, computed } from "vue";

const listReservation = ref([]);
const search = ref("");
const selectedFilter = ref("todas");
const user = ref(null);

// Obter o usuário do localStorage
onMounted(async () => {
  const storedUser = localStorage.getItem("user");
  if (storedUser) {
    user.value = JSON.parse(storedUser);
    console.log(user.value)
  }else{
    router.push('/');
  }
  try {
    const response = await fetch(
      "http://localhost/condomino/src/backend/controllers/listReservation.php",
      { method: "GET" }
    );
    const json = await response.json();
    if (json.success) {
      listReservation.value = json.data;
      console.log(listReservation.value);
    } else {
      console.error("Erro na resposta:", json.message);
    }
  } catch (error) {
    console.log("Erro ao buscar dados:", error);
  }

  console.log(new Date());
});

// Função que filtra as reservas com base na seleção e no tipo de usuário
const filteredReservations = computed(() => {
  if (search.value) {
    return listReservation.value.filter(
      (reserva) =>
        reserva.proposito.toLowerCase().includes(search.value.toLowerCase()) ||
        reserva.area.toLowerCase().includes(search.value.toLowerCase())
    );
  }

  const { start: weekStart, end: weekEnd } = getWeekStartAndEnd();
  const { start: monthStart, end: monthEnd } = getMonthStartAndEnd();

  return listReservation.value.filter((reserva) => {
    const reservaDate = new Date(reserva.data_reserva);

    // Se o usuário não for "morador", listar apenas as reservas aprovadas
    if (user.value && user.value.typeUser === 'morador' && reserva.aprovacao != 'aprovado') {
      return false; // Ignora reservas que não estão aprovadas
    }

    if (selectedFilter.value === "semana") {
      return reservaDate >= weekStart && reservaDate <= weekEnd;
    } else if (selectedFilter.value === "mes") {
      return reservaDate >= monthStart && reservaDate <= monthEnd;
    }

    return true; // "Todas" as reservas
  });
});


// const filteredReservation = computed(() => {
//   return listReservation.value.filter(reserva =>
//   seletedUser.value === '' || user.typeUser === seletedUser.value
//   );
// });

const searcFiltre = computed(() => {
  return listReservation.value.filter(
    (reserva) =>
      reserva.proposito.toLowerCase().includes(search.value.toLowerCase()) ||
      search.value == reserva.area ||
      search.value == ""
  );
});

const reservationsThisWeek = computed(() => {
  const { start: weekStart, end: weekEnd } = getWeekStartAndEnd();
  return listReservation.value.filter((reserva) => {
    const reservaDate = new Date(reserva.data_reserva);
    return reservaDate >= weekStart && reservaDate <= weekEnd;
  }).length;
});

const reservationsThisMonth = computed(() => {
  const { start: monthStart, end: monthEnd } = getMonthStartAndEnd();
  return listReservation.value.filter((reserva) => {
    const reservaDate = new Date(reserva.data_reserva);
    return reservaDate >= monthStart && reservaDate <= monthEnd;
  }).length;
});

const totalReservations = computed(() => {
  return listReservation.value.length;
});

// Função para obter o primeiro e último dia da semana atual
function getWeekStartAndEnd() {
  const today = new Date();
  const firstDayOfWeek = new Date(
    today.setDate(today.getDate() - today.getDay())
  );
  const lastDayOfWeek = new Date(firstDayOfWeek);
  lastDayOfWeek.setDate(firstDayOfWeek.getDate() + 6);

  return { start: firstDayOfWeek, end: lastDayOfWeek };
}

// Função para obter o mês atual
function getMonthStartAndEnd() {
  const today = new Date();
  const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
  const lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

  return { start: firstDayOfMonth, end: lastDayOfMonth };
}
</script>

<style scoped>
#box {
  height: 75vh;
  overflow-y: auto;
  scrollbar-width: thin;
}

.dash {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(163, 163, 163, 0.5);
}

.amount,
h5 {
  color: #003b41;
}

span {
  font-size: 14px;
}

.btn {
  background: var(--inactive-color);
  color: var(--text-white);
}

.btn:hover {
  background: var(--active-color);
}
</style>