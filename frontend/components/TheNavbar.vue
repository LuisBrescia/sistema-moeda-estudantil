<script setup>
const route = useRoute();

const checkExact = (path) => {
  console.log(route.path, path);
  return route.path === path ? 'primary' : 'secondary';
};
</script>

<template>
  <BaseNavbar>
    <div class="my-auto flex items-center">
      <Button
        @click="navigateTo('/')"
        :severity="checkExact('/')"
        size="small"
        label="Apresentação"
        text
        arial-label="Apresentação"
      />
      <Button
        severity="secondary"
        size="small"
        label="Soluções"
        text
        arial-label="Soluções"
        disabled
      />
      <Button
        severity="secondary"
        size="small"
        label="Contato"
        text
        arial-label="Contato"
        disabled
      />
    </div>
  </BaseNavbar>
</template>

<style>
.p-button-icon-only {
  color: var(--p-surface-900, red) !important;
  font-weight: 700;
}

.dark .p-button-icon-only {
  color: var(--p-surface-50) !important;
}
</style>
