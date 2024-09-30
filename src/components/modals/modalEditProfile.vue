<template>
  <!-- Modal de Edição -->
  <div
    class="modal fade"
    id="editU"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editUserModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editUserModalLabel">
            <i class="fa-solid fa-user-edit"></i> Editar Usuário
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row gap-1 justify-content-center">
            <div class="col-md-10 mb-2">
              <span class="fw-semibold mb-2">Nome Completo</span>
              <inputs
                input-type="text"
                icon="fa-solid fa-lines-leaning"
                pHolder="Nome Completo"
                v-model="editUser.name_user"
              />
            </div>
            <div class="col-md-10 mb-2">
              <span class="fw-semibold mb-2">Telefone</span>
              <inputs
                input-type="number"
                icon="fa-solid fa-phone"
                pHolder="Telefone"
                v-model="editUser.telephone"
              />
            </div>
            <div class="col-md-10 mb-2">
              <span class="fw-semibold mb-2">Email</span>
              <inputs
                input-type="email"
                icon="fa-regular fa-envelope"
                p-holder="Email"
                v-model="editUser.email"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark fw-semibold"
            data-bs-dismiss="modal"
          >
            <i class="fa-solid fa-xmark"></i> Cancelar
          </button>
          <button
            type="button"
            class="btn btn-success fw-semibold"
            @click="updateUser"
          >
            <i class="fa-solid fa-check"></i> Salvar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import { ref, watch, onMounted } from "vue";
import inputs from "../inputs.vue";
import axios from "axios";

const editUser = ref({
  id: null,
  name_user: "",
  telephone: "",
  email: "",
  nhouse: null,
  typeUser: "",
});

const user = ref(null);

let listTypeUser = ref([
  { val: "morador", name: "Morador" },
  { val: "seguranca", name: "Segurança" },
  { val: "admin", name: "Administrador" },
]);

const listHouse = ref("");

// Atualiza o objeto `editUser` sempre que `userToEdit` mudar
//   watch(() => props.userToEdit, (newVal) => {
//     editUser.value = { ...newVal };
//   });

const updateUser = async () => {
  try {
    const response = await axios.post(
      "http://localhost/condomino/src/backend/controllers/updateUser.php",
      editUser.value
    );

    if (response.data.success) {
      console.log("Usuário atualizado com sucesso:", response.data.message);
      location.href = "/profile"; // Redireciona ou atualiza a lista
    } else {
      console.log("Erro ao atualizar usuário:", response.data.message);
    }

    console.log(editUser.value)
  } catch (error) {
    console.error("Erro ao atualizar usuário:", error);
  }
};

onMounted(async () => {
  const storedUser = localStorage.getItem("user");
  if (storedUser) {
    user.value = JSON.parse(storedUser);
    editUser.value = {
      id: user.value.id,
      name_user: user.value.name_user,
      telephone: user.value.telephone,
      email: user.value.email,
      nhouse: user.value.nhouse,
      typeUser: user.value.typeUser,
    };
  }
});
</script>
    
     <style scoped>
cite {
  font-size: 13px;
}

textarea {
  width: 100%;
  border: 1px solid var(--inactive-color);
  border-radius: 5px;
  outline: none;
  padding: 10px;
  font-weight: 500;
}

#anexo {
  display: none;
}
#anex {
  text-decoration: underline;
  font-weight: 600;
  color: var(--active-house);
  cursor: pointer;
}
</style>