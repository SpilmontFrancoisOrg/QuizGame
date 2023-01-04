<template>
  <div v-if="!started" class="center-component card py-6 space-y-4 w-1/2">
    <img src="@/assets/logo.png" />
    <div class="flex flex-col space-y-2 w-2/3">
      <label for="name" class="text-xl">Nom du joueur :</label>
      <input v-model="name" type="text" name="name" />
    </div>
    <div class="flex flex-col space-y-2 w-2/3">
      <label for="number" class="text-xl">Nombre de questions :</label>
      <input v-model="number" type="number" name="number" min="1" />
    </div>
    <div class="flex flex-col space-y-2 w-2/3">
      <label for="difficulty" class="text-xl">Difficulté</label>
      <select v-model="difficulty" name="difficulty">
        <option value="1">Facile</option>
        <option value="2">Moyen</option>
        <option value="3">Difficile</option>
      </select>
    </div>

    <button class="btn-success" @click="startGame()">Jouer !</button>
  </div>

  <Game v-else :game="currentGame" @endGame="endGame" />
</template>

<script>
export default {
  data() {
    return {
      name: '',
      number: 1,
      difficulty: '',
      started: false,
      currentGame: null,
    }
  },
  methods: {
    async startGame() {
      if (this.name && this.difficulty) {
        const { data } = await this.$axios.$get(
          `/api/games?number=${this.number}&difficulty=${this.difficulty}&name=${this.name}&theme=${this.$route.query.theme}`
        )
        if (data.questions.length > 0) {
          this.started = true
          this.currentGame = data
        } else {
          // TODO : no questions found
        }
      }
    },
    endGame() {
      this.started = false
      this.currentGame = null
    },
  },
}
</script>
