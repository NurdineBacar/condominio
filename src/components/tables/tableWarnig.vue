<template>
  <div>
    <table>
      <!-- <thead>
                <tr>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                    <td>Casa</td>
                    <td>Estado</td>
                    <td>Operacoes</td>
                </tr>
            </thead> -->
      <tbody>
        <tr v-for="warn in warns" :key="warn.id">
          <td class="ps-4">
            <div class="d-flex gap-2 align-items-center">
                <i class="fa-solid fa-triangle-exclamation fs-2"></i>
              <h6 class="fs-6">
                <a href="fw-bold">{{ warn.titulo }}</a>
              </h6>
            </div>
          </td>
          <td>
            {{
              warn.observacoes && warn.observacoes.length > 20
                ? warn.observacoes.slice(0, 35) + "..."
                : warn.observacoes || "Sem observações"
            }}
          </td>
          <td>
            {{ warn.data_validade }}
          </td>
          <td>
            <span class="badge bg-primary">{{ warn.nivel_prioridade }}</span>
          </td>
          <td class="ps-2">
            <span class="badge bg-primary">{{ warn.estado }}</span>
          </td>
          <td class="px-2">
            <div class="d-flex gap-3 justify-content-center">
              <i class=""></i>
              <a
                href=""
                @click.prevent="showWarning(warn.id)"
                data-bs-toggle="modal"
                data-bs-target="#view"
                ><i class="fa-solid fa-up-right-from-square fs-6"></i
              ></a>
              <a href="" @click.prevent="deleteWarning(warn.id)" v-show="access.typeUser =='admin'"><i class="fa-solid fa-trash fs-6"></i></a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <mView :view="dataView" />
  </div>
</template>

<script setup>
import mView from "../modals/viewWarning.vue";
import { defineProps, ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps(["warns"]);
const dataView = ref([]);
const listWarning = ref("");
const access = ref('')

const deleteWarning = async (id_user) => {
  try {
    const response = await axios.post(
      "http://localhost/condomino/src/backend/controllers/deleteUser.php",
      {
        id: id_user,
      }
    );

    if (response.data.success) {
      console.log("Usuario elimidao com, sucesso");
    } else {
      console.log("errro ao deltar o usaurio: ", response.data.message);
    }
  } catch (error) {
    console.log("Erro ao buscadar dados: ", error);
  }
};

onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  access.value = JSON.parse(storedUser);
  try {
    const response = await fetch(
      "http://localhost/condomino/src/backend/controllers/listWarnings.php",
      { method: "GET" }
    );
    const json = await response.json();
    if (json.success) {
      listWarning.value = json.data;
      console.log(listWarning.value);
    } else {
      console.error("Erro na resposta:", json.message);
    }
  } catch (error) {
    console.log("Erro ao buscar dados:", error);
  }
});

function showWarning(id) {
  const selectedWarning = listWarning.value.find(warn => warn.id === id);
  if (selectedWarning) {
    dataView.value = {
      title: selectedWarning.titulo,
      level: selectedWarning.nivel_prioridade,
      type: selectedWarning.tipo,
      reg_date: selectedWarning.data_registo,
      end_date: selectedWarning.data_validade,
      details: selectedWarning.observacoes,
      status: selectedWarning.estado,
      reservation: false,
    };
    
    // Abre o modal programaticamente
    const modalElement = new bootstrap.Modal(document.getElementById('view'));
    modalElement.show();
  } else {
    console.error('Aviso não encontrado.');
  }
}

</script>


<style scoped>
table {
  border-collapse: collapse;
  font-size: 14px;
  text-align: center;
  font-weight: 500;
  width: 100%;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(163, 163, 163, 0.5);
  border-radius: 5px;
}

table thead tr {
  text-align: center;
  border-bottom: 1px solid rgb(179, 177, 177);
}

tbody tr td {
  padding: 10px 0;
}

tbody tr {
  border-bottom: 1px solid rgb(179, 177, 177);
}
tbody tr:last-child {
  border-bottom: none;
}

a {
  text-decoration: none;
  color: var(--inactive-color);
}
a:hover {
  color: var(--active-color);
}
</style>