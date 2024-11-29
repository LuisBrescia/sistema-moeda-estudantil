<script setup lang="ts">
import { computed } from 'vue';
type Shape = 'circle' | 'square' | undefined;

const props = defineProps({
  letra: {
    type: String as PropType<string | undefined>, // string ou undefined
    required: false,
  },
  shape: {
    type: String as () => Shape,
    default: 'circle',
  },
});

const colorMode = useColorMode();
const brightness = computed(() => (colorMode.preference === 'light' ? 50 : 30));

const getColors = (letra: string | undefined) => {
  if (!letra) {
    const backgroundColor = `hsl(0, 0%, ${brightness}%)`;
    const textColor = `hsl(0, 0%, ${brightness}%)`;
    return { backgroundColor, textColor };
  }

  const lowerLetter = letra.toLowerCase();
  const alphabet = 'abcdefghijklmnopqrstuvwxyz';
  const index = alphabet.indexOf(lowerLetter);

  if (index === -1) {
    const backgroundColor = `hsl(0, 50%, 50%)`;
    const textColor = `hsl(0, 50%, 90%)`;
    return { backgroundColor, textColor };
  }

  const hue = (index / 26) * 360;

  const backgroundColor = `hsl(${hue}, 50%, 50%)`;
  const textColor = `hsl(${hue}, 50%, 90%)`;

  return { backgroundColor, textColor };
};

const colors = computed(() => getColors(props.letra));
</script>

<template>
  <Avatar
    v-if="letra"
    :label="letra.toUpperCase()"
    :shape="shape"
    :style="`background-color: ${colors.backgroundColor}; color: ${colors.textColor};`"
  />
  <Avatar
    v-else
    :shape="shape"
    :style="`background-color: ${colors.backgroundColor}; color: ${colors.textColor};`"
  />
</template>
