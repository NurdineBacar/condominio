<template>
    <div class="modal fade" id="userListModal" tabindex="-1" aria-labelledby="userListModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userListModalLabel">Moradores da Casa nº {{ house.nhouse }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul v-if="users.length > 0">
                        <li v-for="user in users" :key="user.id">
                            <img :src="user.photo" alt="" width="35" height="35" class="rounded-circle">
                            {{ user.name_user }} ({{ user.email }})
                        </li>
                    </ul>
                    <p v-else>Nenhum morador encontrado.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps(['house']);
const users = ref([]);

const fetchUsers = async () => {
    try {
        const response = await fetch(`http://localhost/condomino/src/backend/controllers/getUsers.php?nhouse=${house.nhouse}`, { method: 'GET' });
        const json = await response.json();
        if (json.success) {
            users.value = json.data;
        } else {
            console.error('Erro na resposta:', json.message);
        }
    } catch (error) {
        console.error('Erro ao buscar usuários:', error);
    }
};

watch(() => house, fetchUsers);
</script>
