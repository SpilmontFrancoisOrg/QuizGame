<template>
  <div v-if="!started" class="center-component card py-6 space-y-4 w-1/2">
    <div class="flex items-center justify-between px-6 w-full">
      <HomeButton />
      <div class="flex items-center justify-center w-1/3">
        <span class="text-2xl font-semibold">Paramètres de jeu</span>
      </div>
      <div class="w-1/3" />
    </div>
    <div class="flex flex-col space-y-2 w-2/3">
      <label for="name" class="text-xl">Nom du joueur :</label>
      <input v-model="name" type="text" name="name" />
    </div>
    <div class="flex flex-col space-y-2 w-2/3">
      <label for="number" class="text-xl">Nombre de questions max :</label>
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
      name: null,
      number: 1,
      difficulty: 1,
      started: false,
      currentGame: null,
      timer: 0,
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

          setInterval(() => {
            this.timer += 0.1
          }, 100)
        } else {
          const toast = this.$toast.error(
            "Aucune question n'a été trouvée avec ces paramètres"
          )
          setTimeout(() => {
            toast.remove()
          }, 5000)
        }
      } else {
        const toast = this.$toast.error('Veuillez remplir tous les champs')
        setTimeout(() => {
          toast.remove()
        }, 5000)
      }
    },
    async endGame(score) {
      await this.$axios.$post(`/api/games/${this.currentGame.game.id}/end`, {
        score,
        time: this.timer,
      })

      this.started = false
      this.currentGame = null
    },
  },
}
</script>
