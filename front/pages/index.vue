<template>
  <div>
    <div class="card flex-row justify-between p-6">
      <div class="w-1/3">
        <img src="@/assets/logo.png" class="h-16 w-16" />
      </div>
      <div class="w-1/3 flex items-center justify-center">
        <span class="font-semibold text-2xl">Choisissez le thème</span>
      </div>
      <div class="w-1/3" />
    </div>

    <div class="flex flex-wrap">
      <div
        v-for="theme in themes"
        :key="theme.id"
        class="
          card
          justify-center
          cursor-pointer
          w-[200px]
          h-32
          bg-no-repeat bg-center
          m-10
        "
        :style="{ backgroundImage: 'url(' + theme.image + ')' }"
        @click="chooseTheme(theme.id)"
      >
        <span class="bg-white rounded-full px-2 py-1 text-xl font-bold">
          {{ theme.name }}
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      themes: null,
    }
  },
  mounted() {
    this.getThemes()
  },
  methods: {
    async getThemes() {
      const { data } = await this.$axios.$get('/api/themes')
      this.themes = data
    },
    chooseTheme(id) {
      this.$router.push(`/game?theme=${id}`)
    },
  },
}
</script>