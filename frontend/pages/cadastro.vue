<script setup>
import { useUsuarioStore } from '@/stores/usuarioStore';

definePageMeta({
  layout: false,
  middleware: ['redirect-if-authenticated'],
});

const formData = ref({
  // * STEP 1 (Faculdade)
  instituicao_id: null,
  departamento_id: null,

  // * STEP 2 (Nome)
  nome: '',
  cpf: '',
  rg: '',

  // * STEP 3 (Dados)
  endereco: '',

  // * STEP 3 (Contato)
  telefone: '',
  email: '',

  // * STEP 5 (Senha)
  senha: '',
});

const handleSubmitLoading = ref(false);
const instituicoesData = ref([]);

const getInstituicoes = async () => {
  try {
    const res = await useApiRequest('/instituicoes/all');
    instituicoesData.value = res.data;
  } catch (error) {
    console.error(error);
  }
};

const handleSubmit = async () => {
  handleSubmitLoading.value = true;

  try {
    const res = await useApiRequest('/register', {
      method: 'POST',
      body: formData.value,
    });

    const usuarioStore = useUsuarioStore();
    usuarioStore.login(res.data);
    navigateTo('/home');
  } catch (error) {
    console.error(error);
  } finally {
    handleSubmitLoading.value = false;
  }
};

// const formRules = {
//   nome_fantasia: computed(() => !formData.value.nome_fantasia),
// };

const formRulesNome = computed(
  () => formData.value.nome.length <= 3 || formData.value.nome.length > 21,
);

const buscarDadosCep = async (cep) => {
  if (!cep || cep.length !== 9) return; // Verifica se o CEP está completo (99999-999)
  try {
    const response = await fetch(
      `https://viacep.com.br/ws/${cep.replace('-', '')}/json/`,
    );
    const data = await response.json();
    if (data.erro) {
      console.error('CEP inválido');
      return;
    }
    formData.value.cidade = data.localidade || '';
    formData.value.logradouro = data.logradouro || '';
  } catch (error) {
    console.error('Erro ao buscar CEP:', error);
  }
};

// Observa mudanças no CEP
watch(
  () => formData.value.endereco,
  (newCep) => {
    buscarDadosCep(newCep);
  },
);

onMounted(() => {
  getInstituicoes();
});
</script>

<template>
  <div class="h-screen w-screen dark:bg-surface-900">
    <div class="container mx-auto h-full pt-8">
      <Stepper value="1">
        <StepList>
          <Step value="1">Instituição</Step>
          <Step value="2">Perfil</Step>
          <Step value="3">Contato</Step>
          <Step value="4">Endereço</Step>
          <Step value="5">Senha</Step>
        </StepList>

        <StepPanels>
          <StepPanel
            v-slot="{ activateCallback }"
            value="1"
            class="container mx-auto mt-8 flex max-w-xl flex-col items-center gap-4"
          >
            <h1 class="mb-8 text-xl">Selecione instituição e curso</h1>

            <Select
              v-model="formData.instituicao_id"
              name="instituicao_id"
              :options="instituicoesData"
              optionLabel="nome"
              optionValue="id"
              placeholder="Selecione a instituição"
              class="w-full text-center"
            />

            <Select
              v-if="formData.instituicao_id"
              v-model="formData.departamento_id"
              name="instituicao_id"
              :options="
                instituicoesData.find(
                  (instituicao) => instituicao.id === formData.instituicao_id,
                ).departamentos
              "
              optionLabel="nome"
              optionValue="id"
              placeholder="Selecione o curso"
              class="w-full text-center"
            />

            <p class="mb-8 text-xs">
              Caso sua instituição não esteja listada, entre em contato pelo
              nosso
              <a href="mailto:atendimento@syscon.com" class="text-primary-500">
                email.
              </a>
            </p>

            <div class="flex gap-4">
              <Button
                label="Próximo"
                size="small"
                class="w-28"
                @click="activateCallback('2')"
              />
            </div>
          </StepPanel>

          <StepPanel
            v-slot="{ activateCallback }"
            value="2"
            class="container mx-auto mt-8 flex max-w-xl flex-col items-center gap-4"
          >
            <h1 class="mb-8 text-xl">Complete com seus dados</h1>

            <InputText
              v-model="formData.nome"
              name="nome"
              type="text"
              placeholder="Seu nome"
              fluid
              class="text-center"
            />
            <InputMask
              v-model="formData.cpf"
              mask="999.999.999-99"
              placeholder="CPF"
              fluid
              class="text-center"
            />
            <InputMask
              v-model="formData.rg"
              mask="99.999.999-9"
              placeholder="RG"
              fluid
              class="text-center"
            />

            <p class="mb-8 text-xs">
              CPF e RG são visíveis apenas para a instituição.
            </p>

            <div class="flex gap-4">
              <Button
                label="Voltar"
                severity="secondary"
                size="small"
                class="w-28"
                @click="activateCallback('1')"
              />
              <Button
                label="Próximo"
                color="primary"
                size="small"
                class="w-28"
                :disabled="formRulesNome"
                @click="activateCallback('3')"
              />
            </div>
          </StepPanel>

          <StepPanel
            v-slot="{ activateCallback }"
            value="3"
            class="container mx-auto mt-8 flex max-w-xl flex-col items-center gap-4 text-center"
          >
            <h1 class="mb-8 text-xl">Contato</h1>

            <InputMask
              v-model="formData.telefone"
              inputId="telefone"
              mask="(99) 99999-9999"
              fluid
              placeholder="Telefone"
              class="w-full text-center"
            />

            <InputText
              v-model="formData.email"
              name="email"
              type="email"
              placeholder="E-mail"
              fluid
              class="w-full text-center"
            />

            <p class="mb-8 text-xs">
              Por padrão é visível a todos que utilizam a plataforma.
            </p>

            <div class="flex gap-4">
              <Button
                label="Voltar"
                severity="secondary"
                size="small"
                class="w-28"
                @click="activateCallback('2')"
              />
              <Button
                label="Continuar"
                size="small"
                class="w-28"
                @click="activateCallback('4')"
              />
            </div>
          </StepPanel>

          <StepPanel
            v-slot="{ activateCallback }"
            value="4"
            class="container mx-auto mt-8 flex max-w-xl flex-col items-center gap-4 text-center"
          >
            <h1 class="mb-8 text-xl">Endereço de moradia</h1>

            <!-- CEP com InputMask -->
            <InputMask
              v-model="formData.endereco"
              inputId="cep"
              mask="99999-999"
              fluid
              placeholder="CEP"
              class="text-center"
            />

            <InputText
              v-model="formData.cidade"
              name="cidade"
              type="text"
              placeholder="Cidade"
              fluid
              class="text-center"
              readonly
            />

            <InputText
              v-model="formData.logradouro"
              name="logradouro"
              type="text"
              placeholder="Logradouro"
              fluid
              class="text-center"
              readonly
            />

            <p class="mb-8 text-xs">
              Por padrão é visível a todos que acessam a unidade.
            </p>

            <div class="flex gap-4">
              <Button
                label="Voltar"
                severity="secondary"
                size="small"
                class="w-28"
                @click="activateCallback('3')"
              />
              <Button
                label="Continuar"
                size="small"
                class="w-28"
                @click="activateCallback('5')"
              />
            </div>
          </StepPanel>

          <StepPanel
            v-slot="{ activateCallback }"
            value="5"
            class="container mx-auto mt-8 flex max-w-xl flex-col items-center gap-4 text-center"
          >
            <h1 class="mb-8 text-xl">Crie sua senha</h1>

            <Password
              v-model="formData.senha"
              toggle-mask
              name="senha"
              placeholder="Senha"
              :input-class="['w-full']"
              fluid
              class="w-full text-center"
              @keydown.enter="handleSubmit"
            />

            <div class="flex gap-4">
              <Button
                label="Voltar"
                severity="secondary"
                size="small"
                class="w-28"
                @click="activateCallback('4')"
              />
              <Button
                label="Concluir"
                size="small"
                class="w-28"
                :loading="handleSubmitLoading"
                @click="handleSubmit"
              />
            </div>
          </StepPanel>
        </StepPanels>
      </Stepper>

      <pre>
        {{ formData }}
      </pre>
    </div>
  </div>
</template>
