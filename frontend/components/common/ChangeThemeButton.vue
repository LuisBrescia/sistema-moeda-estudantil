<script setup>
const colorMode = useColorMode();

const changeColorTheme = () => {
  colorMode.preference = colorMode.preference === 'light' ? 'dark' : 'light';
};

const buttonIcon = computed(() => {
  return colorMode.preference === 'light' ? 'pi pi-moon' : 'pi pi-sun';
});
</script>

<template>
  <Button
    :icon="buttonIcon"
    @click="changeColorTheme"
    severity="secondary"
    text
    rounded
    arial-label="Trocar tema"
  />
</template>
