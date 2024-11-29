<script lang="ts" setup>
const handleCellClick = () => {
  console.log('MesaGrandeRetangular clicked');
};

const props = defineProps<{
  mesa: any;
}>();

const emits = defineEmits<{
  (e: 'delete', mesa: any): void;
  (e: 'duplicate', mesa: any): void;
}>();

const menu = ref();
// MenuItem[]
const items = ref<any[]>([
  {
    label: 'Editar',
    icon: 'pi pi-pencil',
    command: () => (editDrawer.value = true),
  },
  {
    label: 'Duplicar',
    icon: 'pi pi-copy',
    command: () => emits('duplicate', props.mesa),
  },
  {
    separator: true,
  },
  {
    label: 'Apagar',
    icon: 'pi pi-trash',
    command: () => emits('delete', props.mesa),
  },
]);

const onImageRightClick = (event: Event) => {
  menu.value.show(event);
};

const editDrawer = ref(false);

const formData = ref({
  nome: '',
  minimo_pessoas: 3,
  maximo_pessoas: 4,
  disponivel_reserva: true,
});

const maximoMesa = 8;
</script>

<template>
  <div
    class="rectangle relative"
    :style="{ opacity: formData.disponivel_reserva ? 1 : 0.5 }"
    aria-haspopup="true"
    @click="handleCellClick"
    @contextmenu="onImageRightClick"
  >
    <div class="chair chair-1 bg-surface-300 dark:bg-surface-800" />
    <div class="chair chair-2 bg-surface-300 dark:bg-surface-800" />
    <div class="chair chair-3 bg-surface-300 dark:bg-surface-800" />
    <div class="chair chair-4 bg-surface-300 dark:bg-surface-800" />
    <div class="rectangle-fill bg-surface-400 dark:bg-surface-700" />

    <div class="mesa-nome text-xs">
      <p class="mb-1 text-center text-white">
        {{ mesa.nome }}
      </p>

      <div class="flex justify-center">
        <IconUser color="#f97316" :size="14" />
        <span class="ms-1 text-xs text-white">
          {{ formData.minimo_pessoas }} - {{ formData.maximo_pessoas }}
        </span>
      </div>
    </div>
  </div>

  <ContextMenu ref="menu" :model="items" />
  <Drawer v-model:visible="editDrawer" header="Propriedades" position="right">
    <div class="flex items-center justify-between px-4">
      <span class="text-nowrap text-sm">Nome da mesa</span>
      <InputText size="small" class="w-24 text-center" v-model="mesa.nome" />
    </div>

    <Divider />

    <div class="mb-4 flex items-center justify-between px-4">
      <span class="text-nowrap text-sm">Mínimo de pessoas</span>
      <div class="w-24">
        <InputNumber
          v-model="formData.minimo_pessoas"
          fluid
          showButtons
          :min="1"
          :max="formData.maximo_pessoas"
        >
          <template #incrementbuttonicon>
            <IconPlus :size="16" />
          </template>
          <template #decrementbuttonicon>
            <IconMinus :size="16" />
          </template>
        </InputNumber>
      </div>
    </div>

    <div class="flex items-center justify-between px-4">
      <span class="text-nowrap text-sm">Máximo de pessoas</span>
      <div class="w-24">
        <InputNumber
          v-model="formData.maximo_pessoas"
          fluid
          showButtons
          :min="formData.minimo_pessoas"
          :max="maximoMesa"
        >
          <template #incrementbuttonicon>
            <IconPlus :size="16" />
          </template>
          <template #decrementbuttonicon>
            <IconMinus :size="16" />
          </template>
        </InputNumber>
      </div>
    </div>

    <Divider />

    <div class="flex items-center justify-between px-4">
      <span class="text-nowrap text-sm">Disponível para reservas</span>
      <div class="w-24 text-center">
        <ToggleSwitch name="activation" v-model="formData.disponivel_reserva" />
      </div>
    </div>
  </Drawer>
</template>

<style lang="scss" scoped>
.rectangle {
  width: 100%;
  height: 100%;
}

.rectangle-fill {
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: 10;
}

.chair {
  width: 20%;
  aspect-ratio: 16/9;
  position: absolute;
  border-radius: 25%;

  &.chair-1 {
    left: 10%;
    top: -11%;
  }

  &.chair-2 {
    right: 10%;
    top: -11%;
  }

  &.chair-3 {
    left: 10%;
    bottom: -11%;
  }

  &.chair-4 {
    right: 10%;
    bottom: -11%;
  }
}

.mesa-nome {
  position: absolute;
  z-index: 11;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
