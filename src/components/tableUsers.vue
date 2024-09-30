<template>
    <div>
      <table>
        <thead>
          <tr>
            <td>Foto</td>
            <td>Nome</td>
            <td>Telefone</td>
            <td>Email</td>
            <td>Casa</td>
            <td>Estado</td>
            <td>Operações</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td><img :src="'/img/profile/'+user.photo" width="50px" height="50px" class="rounded" alt=""></td>
            <td>{{ user.name_user }}</td>
            <td>{{ user.telephone }}</td>
            <td>{{ user.email }}</td>
            <td>nº {{ user.nhouse }}</td>
            <td><span class="badge bg-primary">{{ user.ustatus }}</span></td>
            <td>
              <div class="d-flex gap-3 justify-content-center">
                <a href="" @click.prevent="openEditModal(user)"  data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="fa-solid fa-pen-to-square fs-5"></i></a>
                <a href="" @click.prevent="deleteUser(user.id)"><i class="fa-solid fa-trash fs-5"></i></a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <userEditModal :userToEdit="selectedUser"/>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import userEditModal from '../components/userEditModal.vue';
  
  const props = defineProps({
    users: Array,
    listTypeUser: Array,
    listHouses: Array
  });
  
  const selectedUser = ref(null);
  
  const openEditModal = (user) => {
    selectedUser.value = { ...user };
  };
  
  const deleteUser = async (id_user) => {
    try {
      const response = await axios.post("http://localhost/condomino/src/backend/controllers/deleteUser.php", { id: id_user });
  
      if (response.data.success) {
        console.log("Usuário eliminado com sucesso");
        location.href = '/users';
      } else {
        console.log("Erro ao deletar o usuário:", response.data.message);
      }
    } catch (error) {
      console.log("Erro ao deletar o usuário:", error);
    }
  };
  </script>
  


<style scoped>
    table{
        border-collapse: collapse;
        font-size: 16px;
        text-align: center;
        font-weight: 600;
        width: 100%;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
        border-radius: 5px;
    }

    table thead tr{
        text-align: center;
        border-bottom: 1px solid rgb(179, 177, 177);
    }

    tbody tr td{
        padding: 10px 0;
    }

    tbody tr{
        border-bottom: 1px solid rgb(179, 177, 177);
    }
    tbody tr:last-child{
        border-bottom: none;
    }



    a{
        text-decoration: none;
        color: var(--inactive-color);
    }
     a:hover{
        color: var(--active-color);
     }
</style>