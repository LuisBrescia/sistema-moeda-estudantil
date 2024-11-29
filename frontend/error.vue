<template>
  <div class="flex min-h-screen flex-col bg-surface-950">
    <TheNavbar />
    <div class="container mx-auto grid flex-1 place-items-center">
      <div class="flex flex-col items-center">
        <h1 class="mb-4 text-9xl font-black">404</h1>
        <h3 class="mb-4 text-4xl font-semibold">Página não encontrada</h3>
        <h6
          class="mb-8 text-center text-lg text-surface-700 dark:text-surface-300"
        >
          A página que você está procurando não existe ou foi removida.
        </h6>
        <Button
          class="mb-8"
          @click="navigateTo('/')"
          label="Voltar para a Home"
        />
      </div>
    </div>
    <TheFooter />
  </div>
</template>
