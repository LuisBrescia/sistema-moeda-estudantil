<script setup lang="ts">
type Tema = 'system' | 'light' | 'dark';

const colorMode = useColorMode();
const selectTemaPopover = ref();

const handleSelectTemaPopover = (event: Event): void => {
  selectTemaPopover.value.toggle(event);
};

const temaOptions: { label: string; value: Tema }[] = [
  { label: 'Sistema', value: 'system' },
  { label: 'Claro', value: 'light' },
  { label: 'Escuro', value: 'dark' },
];

const recordTemaOptions: Record<Tema, string> = {
  system: 'Sistema',
  light: 'Claro',
  dark: 'Escuro',
};
</script>

<template>
  <Dialog modal class="w-[32rem]" header="Configurações" :draggable="false">
    <div class="flex items-center justify-between">
      <span class="text-sm">Tema</span>
      <div
        @click="handleSelectTemaPopover"
        class="flex cursor-pointer items-center gap-1 pe-2 text-sm"
      >
        <span>{{ recordTemaOptions[colorMode.preference as Tema] }}</span>
        <IconChevronDown
          :size="16"
          class="text-surface-500 dark:text-surface-400"
        />
      </div>
    </div>

    <!-- * Escolha de tema -->
    <Popover
      ref="selectTemaPopover"
      unstyled
      class="rounded-custom mt-2 border border-surface-300 bg-surface-0 py-2 shadow-lg dark:border-surface-700 dark:bg-surface-900"
    >
      <div class="flex w-[8rem] flex-col text-sm">
        <div
          v-for="option in temaOptions"
          :key="option.value"
          class="interativo flex cursor-pointer items-center justify-between px-3 py-2 text-xs"
          @click="colorMode.preference = option.value"
        >
          <span class="text-sm">{{ option.label }}</span>
          <IconCheckCheck
            v-if="colorMode.preference === option.value"
            :size="16"
          />
        </div>
      </div>
    </Popover>
  </Dialog>
</template>
