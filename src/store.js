import { reactive } from 'vue'

const nameUser = sessionStorage.getItem('nomeUser') || ''; 
const emailuser = sessionStorage.getItem('emailUser') || ''; 
const imgUser = sessionStorage.getItem('imgUser') || ''; 
const status = sessionStorage.getItem('status') || ''; 

export const store = reactive({
  nome: nameUser,
  email: emailuser,
  img: imgUser,
  estado: status,
});