<script setup>
import { ref } from 'vue';
import { useUsuarioStore } from '@/stores/usuarioStore';
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';
import { useUnidadeStore } from '@/stores/unidadeStore';
import { useToast } from 'primevue/usetoast';

definePageMeta({
  layout: 'aluno',
  middleware: ['authenticated'],
});

const usuarioStore = useUsuarioStore();
const unidadeStore = useUnidadeStore();
const breadcrumbStore = useBreadcrumbStore();

const toast = useToast();

breadcrumbStore.setBreadcrumb([{ name: 'Loja', to: '/home/loja' }]);

const products = ref([
  {
    name: 'Tênis Esportivo',
    image:
      'https://cdn.discordapp.com/attachments/1314613986830057512/1314690103066628096/pastel-purple-color-solid-background-1920x1080.png?ex=6754b012&is=67535e92&hm=cf9d51dc95cf1ec820035c2148c45388e5e7b033c9ff784882815b70e64570aa&',
    category: 'Roupas e Calçados',
    description:
      'Tênis esportivo de alta performance, ideal para corridas e treinos intensivos.',
    price: 500,
    inventoryStatus: 'INSTOCK',
  },
  {
    name: 'Camiseta Confortável',
    image:
      'https://cdn.discordapp.com/attachments/1314613986830057512/1314690103066628096/pastel-purple-color-solid-background-1920x1080.png?ex=6754b012&is=67535e92&hm=cf9d51dc95cf1ec820035c2148c45388e5e7b033c9ff784882815b70e64570aa&',
    category: 'Roupas',
    description:
      'Camiseta macia e confortável, perfeita para o dia a dia. Disponível em várias cores.',
    price: 300,
    inventoryStatus: 'LOWSTOCK',
  },
  {
    name: 'Relógio Digital',
    image:
      'https://cdn.discordapp.com/attachments/1314613986830057512/1314690103066628096/pastel-purple-color-solid-background-1920x1080.png?ex=6754b012&is=67535e92&hm=cf9d51dc95cf1ec820035c2148c45388e5e7b033c9ff784882815b70e64570aa&',
    category: 'Acessórios',
    description:
      "Relógio digital moderno, à prova d'água e com várias funções como cronômetro e alarme.",
    price: 1000,
    inventoryStatus: 'OUTOFSTOCK',
  },
  {
    name: 'Mochila de Viagem',
    image:
      'https://cdn.discordapp.com/attachments/1314613986830057512/1314690103066628096/pastel-purple-color-solid-background-1920x1080.png?ex=6754b012&is=67535e92&hm=cf9d51dc95cf1ec820035c2148c45388e5e7b033c9ff784882815b70e64570aa&',
    category: 'Acessórios',
    description:
      'Mochila resistente com amplo espaço e compartimentos para organização. Ideal para viagens longas.',
    price: 750,
    inventoryStatus: 'INSTOCK',
  },
]);

const canBuy = (product) => {
  return usuarioStore.saldo >= product.price;
};

const comprarProduto = (product) => {
  if (canBuy(product)) {
    usuarioStore._user.saldo -= product.price;
    toast.add({
      severity: 'success',
      summary: 'Compra realizada',
      detail: `Você gastou ${product.price} pontos. Saldo restante: ${usuarioStore.saldo}`,
      life: 3000,
    });
  } else {
    toast.add({
      severity: 'error',
      summary: 'Erro na compra',
      detail: 'Você não tem pontos suficientes para comprar este produto.',
      life: 3000,
    });
  }
};

const getSeverity = (product) => {
  switch (product.inventoryStatus) {
    case 'INSTOCK':
      return 'success';
    case 'LOWSTOCK':
      return 'warn';
    case 'OUTOFSTOCK':
      return 'danger';
    default:
      return null;
  }
};
</script>

<template>
  <div class="px-6 py-8 md:px-12 lg:px-20">
    <div class="flex flex-col items-start lg:flex-row lg:justify-between">
      <div>
        <div class="text-3xl font-medium text-surface-900 dark:text-surface-0">
          {{ usuarioStore.user.nome }}
        </div>
        <div
          class="flex flex-wrap items-center text-surface-700 dark:text-surface-100"
        >
          <div class="mr-8 mt-4 flex items-center">
            <i class="pi pi-users mr-2" />
            <span>332 Active Users</span>
          </div>
          <div class="mr-8 mt-4 flex items-center">
            <i class="pi pi-globe mr-2" />
            <span>9402 Sessions</span>
          </div>
          <div class="mt-4 flex items-center">
            <i class="pi pi-clock mr-2" />
            <span>2.32m Avg. Duration</span>
          </div>
        </div>
      </div>
      <div class="mt-4 lg:mt-0">
        <Button label="Add" class="mr-2" outlined icon="pi pi-user-plus" />
        <Button label="Save" icon="pi pi-check" />
      </div>
    </div>

    <div
      class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
    >
      <Card
        v-for="(item, index) in products"
        :key="index"
        :style="{ width: '100%', maxWidth: '25rem', overflow: 'hidden' }"
        class="shadow-lg"
      >
        <template #header>
          <img
            :alt="item.name"
            :src="item.image"
            class="h-40 w-full object-cover"
          />
        </template>
        <template #title>{{ item.name }}</template>
        <template #subtitle>{{ item.category }}</template>
        <template #content>
          <p class="text-sm">{{ item.description }}</p>
          <p class="text-xl font-semibold">{{ item.price }} pontos</p>
        </template>
        <template #footer>
          <Button
            label="Comprar"
            :class="{
              'bg-blue-500': canBuy(item),
              'bg-gray-500': !canBuy(item),
            }"
            class="w-full"
            @click="comprarProduto(item)"
          />
        </template>
      </Card>
    </div>
  </div>
</template>

<style scoped>
body,
html {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

main {
  flex-grow: 1;
  overflow-y: auto;
}

.card {
  margin-top: 20px;
}
</style>
