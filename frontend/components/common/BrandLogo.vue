<script setup>
const colorMode = useColorMode();
const primaryColor = ref('#eab308');

primaryColor.value = colorMode.preference === 'light' ? '#eab308' : '#facc15';
</script>

<template>
  <span class="inline-flex items-center gap-1 px-2 py-2">
    <IconReceiptJapaneseYen :color="primaryColor" />
    <span class="text-xl font-semibold">AraVault</span>
  </span>
</template>
