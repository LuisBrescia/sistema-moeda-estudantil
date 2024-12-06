<script setup>
import { useUsuarioStore } from '@/stores/usuarioStore';

const usuarioStore = useUsuarioStore();
const colorMode = useColorMode();
const op = ref();
const toggle = (event) => {
  op.value.toggle(event);
};

const dialogConfiguracoes = ref(false);

const handleLogout = async () => {
  await usuarioStore.logout();
  navigateTo('/login');
};

const dialogConfirmarSaida = ref(false);
</script>

<template>
  <nav
    class="bg-surface-white flex justify-between border-b border-surface-300 bg-surface-0 px-4 py-2 dark:border-surface-700 dark:bg-surface-900"
  >
    <TheBreadcrumb />

    <!-- <div
      class="rounded-custom flex cursor-pointer items-center p-2 dark:bg-surface-800"
    >
      <IconSearch :size="12" />
      <span class="ml-2 text-xs text-surface-500">Pesquisar AraVault</span>
    </div> -->

    <Button
      class="rounded-custom px-1 py-[2px]"
      text
      severity="secondary"
      size="small"
      @click="toggle"
    >
      <div class="inline-flex items-center">
        <AppAvatar
          v-if="usuarioStore.user.nome"
          class="mr-2"
          :letra="usuarioStore.user.nome[0]"
        />
        <Skeleton v-else shape="circle" size="1.6rem" class="mr-2"></Skeleton>
        <span class="text-xs">{{ usuarioStore.user.nome }}</span>
      </div>
      <IconChevronDown
        :size="16"
        class="text-surface-500 dark:text-surface-400"
      />
    </Button>
  </nav>

  <!-- Dados Perfil  -->
  <Popover
    ref="op"
    unstyled
    class="mt-1 border border-surface-300 bg-surface-0 py-2 shadow-lg dark:border-surface-700 dark:bg-surface-900"
  >
    <div class="flex w-[16.8rem] flex-col text-sm">
      <div class="py-4 text-center">
        <AppAvatar
          v-if="usuarioStore.user.nome"
          size="xlarge"
          :letra="usuarioStore.user.nome[0]"
        />
        <Skeleton v-else shape="circle" size="3.2rem" class="mx-auto" />
        <div class="mt-2">
          <h4 class="mb-1 text-sm dark:text-surface-0">
            {{ usuarioStore.user.nome }}
          </h4>
          <p class="text-xs dark:text-surface-300">
            {{ usuarioStore.user.email }}
          </p>
        </div>
      </div>

      <div
        class="interativo flex cursor-pointer items-center justify-between px-6 py-3 text-xs"
      >
        <div class="flex items-center">
          <IconCircleUserRound :size="16" />
          <span class="ml-4">Meu perfil</span>
        </div>
      </div>

      <div
        class="interativo flex cursor-pointer items-center px-6 py-3 text-xs"
        @click="dialogConfiguracoes = true"
      >
        <IconSettings :size="16" />
        <span class="ml-4">Configurações</span>
      </div>

      <div class="my-2 h-[1px] bg-surface-300 dark:bg-surface-700" />

      <div
        class="interativo flex cursor-pointer items-center px-6 py-3 text-xs text-red-500 dark:text-red-400"
        @click="dialogConfirmarSaida = true"
      >
        <IconLogOut :size="16" />
        <span class="ml-4">Deslogar</span>
      </div>
    </div>
  </Popover>

  <!-- Dialog confirmar saida -->
  <Dialog
    v-model:visible="dialogConfirmarSaida"
    modal
    class="w-[24rem]"
    header="Sair do sistema?"
    :draggable="false"
  >
    <div class="text-sm">
      <p>Um novo login será necessário para ser reconectado.</p>
    </div>
    <div class="mt-4 flex justify-end gap-2">
      <Button
        text
        label="Cancelar"
        size="small"
        severity="secondary"
        @click="dialogConfirmarSaida = false"
      />
      <Button
        label="Confirmar"
        size="small"
        severity="danger"
        @click="handleLogout"
      />
    </div>
  </Dialog>

  <CommonModalConfiguracoes v-model:visible="dialogConfiguracoes" />
</template>
