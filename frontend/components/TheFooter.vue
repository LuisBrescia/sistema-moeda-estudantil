<template>
  <footer
    class="border-t border-surface-200 bg-surface-0 dark:border-surface-800 dark:bg-surface-950"
  >
    <div
      class="container mx-auto flex items-center justify-between py-4 text-sm font-medium text-surface-700 dark:text-surface-300"
    >
      <div class="flex items-center">
        <span>@ 2024 Syscoin LTDA</span>
        <Divider layout="vertical" />
        <span>Todos os direitos reservados.</span>
      </div>
      <div class="flex items-center">
        <span class="cursor-pointer hover:underline">
          Politíca de privacide
        </span>
        <Divider layout="vertical" />
        <span class="cursor-pointer hover:underline">Termos e condições</span>
        <Divider layout="vertical" />
        <span class="cursor-pointer hover:underline">Contato</span>
        <Divider layout="vertical" />
        <Button
          class="ml-2"
          icon="pi pi-facebook"
          severity="secondary"
          rounded
          outlined
          arial-label="Facebook"
        />
        <Button
          class="ml-2"
          icon="pi pi-twitter"
          severity="secondary"
          rounded
          outlined
          arial-label="Twitter"
        />
        <Button
          class="ml-2"
          icon="pi pi-linkedin"
          severity="secondary"
          rounded
          outlined
          arial-label="Linkedin"
        />
      </div>
    </div>
  </footer>
</template>
