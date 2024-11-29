<template>
  <nav
    class="sticky top-0 z-50 border-b border-surface-200 bg-surface-0 bg-opacity-90 backdrop-blur dark:border-surface-800 dark:bg-surface-950 dark:bg-opacity-90"
  >
    <div class="container mx-auto flex justify-between py-2">
      <div class="flex flex-1">
        <span class="my-auto text-2xl font-black tracking-tighter">
          Syscoin
        </span>
      </div>

      <slot />

      <div class="flex flex-1 items-center justify-end">
        <CommonChangeThemeButton />
        <Divider layout="vertical" />
        <Button
          icon-pos="right"
          arial-label="Login"
          severity="secondary"
          outlined
          size="small"
          @click="navigateTo('/login')"
        >
          <span class="font-bold text-surface-900 dark:text-surface-50">
            Entrar com sua conta
          </span>
        </Button>
        <Button
          icon="pi pi-arrow-right"
          label="Se cadastrar"
          severity="contrast"
          size="small"
          icon-pos="right"
          arial-label="Cadastro"
          class="ml-2"
          @click="navigateTo('/cadastro')"
        />
      </div>
    </div>
  </nav>
</template>
