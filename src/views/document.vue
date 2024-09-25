<template>
  <div>
    <div ref="cond_pdf" class="row">
      <h4 class="text-center mt-3 mb-5">ADMINISTRAÇÃO DO CONDOMÍNIO</h4>
      <p class="mb-2 text-center mt-4 fw-semibold">COMPROVATIVO DE RESIDÊNCIA</p>
      <div class="col-md-12 mb-5">
        <p>
          Para os devidos efeitos e a pedido do(a) interessado(a), declara-se que <b>{{ nome }}</b>,
          portador(a) de Bilhete de Identidade nº <b>{{ bi }}</b> emitido pelo Arquivo de Identificação Civil
          {{ arq_identity }}, aos {{ emissao }}, estado civil <b>{{ civil }}</b>, profissão <b>{{ profissao }}</b>, nacionalidade <b>{{ nacionalidade }}</b>,
          natural de <b>{{ natural }}</b>, distrito <b>{{ distrito }}</b>, província de <b>{{ provincia }}</b>, nascido(a) aos <b>{{ data_nasc }}</b>, filho(a) de <b>{{ pai }}</b>
          e da <b>{{ mae }}</b>, residente no bairro de <b>{{ endereco }}</b>, bloco <b>...........</b>, edifício <b>...........</b>, apartamento nº <b>{{ user.nhouse }}</b>,
          área deste distrito. Necessita de confirmação de residência para efeitos de: <b>{{ efeitos_de }}</b>.<br>
          Por ser verdade, passei-lhe a presente declaração que vai por assinatura, para apresentar na Estrutura de Administração do bairro de {{ estr_admin }}
        </p>
      </div>

      <div class="col-md-12 mt-3">
        <p class="text-center">Maputo aos ........ de .......... de .....</p>
        <p class="text-center">Administração do Condomínio</p>
      </div>
      <div class="col-md-12">
        <p class="text-center">................................................................................</p>
      </div>
    </div>

    <div class="col-md-12 mb-5">
        <div class="row">
          <div class="col-md-6">
            <label>N º De BI</label>
            <inputs :input-type="'text'" pholder="Nº BI" icon="fa-solid fa-id-card" v-model="bi"/>
          </div>
          <div class="col-md-6">
            <label>Nome Completo</label>
            <inputs :input-type="'text'" pholder="Nº BI" icon="fa-solid fa-id-card" v-model="nome"/>
          </div>
          <div class="col-md-6">
            <label>Arquivo de Identidade Civil</label>
            <inputs :input-type="'text'" pholder="Arquivo de Identidade" icon="fa-solid fa-id-card" v-model="arq_identity"/>
          </div>
          <div class="col-md-6">
            <label>Data de Emissão</label>
            <inputs :input-type="'text'" pholder="Data de Emissão" icon="fa-solid fa-calendar" v-model="emissao"/>
          </div>
          <div class="col-md-6">
            <label>Estado Civil</label>
            <inputs :input-type="'text'" pholder="Estado Civil" icon="fa-solid fa-id-card" v-model="civil"/>
          </div>
          <div class="col-md-6">
            <label>Profissão</label>
            <inputs :input-type="'text'" pholder="Profissão" icon="fa-solid fa-id-card" v-model="profissao"/>
          </div>
          <div class="col-md-6">
            <label>Nacionalidade</label>
            <inputs :input-type="'text'" pholder="Nacionalidade" icon="fa-solid fa-id-card" v-model="nacionalidade"/>
          </div>
          <div class="col-md-6">
            <label>Natural de</label>
            <inputs :input-type="'text'" pholder="Natural de" icon="fa-solid fa-id-card" v-model="natural"/>
          </div>
          <div class="col-md-6">
            <label>Distrito</label>
            <inputs :input-type="'text'" pholder="Distrito" icon="fa-solid fa-id-card" v-model="distrito"/>
          </div>
          <div class="col-md-6">
            <label>Província</label>
            <inputs :input-type="'text'" pholder="Província" icon="fa-solid fa-id-card" v-model="provincia"/>
          </div>
          <div class="col-md-6">
            <label>Data de Nascimento</label>
            <inputs :input-type="'text'" pholder="Data de Nascimento" icon="fa-solid fa-id-card" v-model="data_nasc"/>
          </div>
          <div class="col-md-6">
            <label>Nome do Pai</label>
            <inputs :input-type="'text'" pholder="Nome do Pai" icon="fa-solid fa-id-card" v-model="pai"/>
          </div>
          <div class="col-md-6">
            <label>Nome da Mãe</label>
            <inputs :input-type="'text'" pholder="Nome da Mãe" icon="fa-solid fa-id-card" v-model="mae"/>
          </div>
          <div class="col-md-6">
            <label>Residente do Bairro (Bairro Atual)</label>
            <inputs :input-type="'text'" pholder="Residente do Bairro" icon="fa-solid fa-id-card" v-model="endereco"/>
          </div>
          <div class="col-md-6">
            <label>Para Efeitos de</label>
            <inputs :input-type="'text'" pholder="Para Efeitos de" icon="fa-solid fa-id-card" v-model="efeitos_de"/>
          </div>
          <div class="col-md-6">
            <label>Estructura de Administracao do bairro</label>
            <inputs :input-type="'text'" pholder="Para Efeitos de" icon="fa-solid fa-id-card" v-model="estr_admin"/>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="d-flex justify-content-center">
          <button class="btn btn-success mx-auto" @click="gerarPdf">Gerar PDF</button>
        </div>
      </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import inputs from "../components/inputs.vue";
import html2pdf from 'html2pdf.js';

const user = ref('');
const cond_pdf = ref('');

const nome= ref('');
const estr_admin= ref('');
const pai = ref('');
const mae = ref('');
const distrito = ref('');
const efeitos_de = ref('');
const endereco = ref('');
const data_nasc = ref('');
const provincia = ref('');
const nacionalidade = ref('');
const profissao = ref('');
const civil = ref('');
const emissao = ref('');
const arq_identity = ref('');
const bi = ref('');
const natural = ref('');

// Carrega os dados do usuário ao montar o componente
onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
      user.value = JSON.parse(storedUser);
  } else {
      // Se o usuário não estiver logado, redireciona para a página de login
      router.push('/');
  }
});

const gerarPdf = () => {
  const opcoes = {
      margin: 1,
      filename: 'documento.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
  };

  // Gerar e baixar o PDF
  html2pdf().from(cond_pdf.value).set(opcoes).save();
}
</script>

<style scoped>
p {
  text-align: justify;
}
</style>
