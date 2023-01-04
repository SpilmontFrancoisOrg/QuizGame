<template>
  <div class="space-y-6">
    <div class="card flex-row justify-evenly p-4">
      <span class="text-2xl font-semibold">Partie en cours</span>

      <span class="text-xl font-semibold"> Score : {{ score }} </span>

      <span class="text-xl font-semibold">
        Question {{ currentQuestion + 1 }} sur
        {{ game.questions.length }}
      </span>
    </div>

    <div class="card p-4">
      <div class="flex flex-col space-y-6">
        <span class="text-xl font-semibold text-center">
          {{ game.questions[currentQuestion].question.name }}
        </span>

        <div class="grid grid-cols-2 gap-4">
          <button
            v-for="(answer, index) in game.questions[currentQuestion]
              .answers"
            :key="index"
            class="btn-primary"
            :class="{
              'btn-success': hasAnswered && answer.is_correct,
              'btn-danger': hasAnswered && !answer.is_correct,
            }"
            :disabled="hasAnswered"
            @click="checkAnswer(answer)"
          >
            {{ answer.name }}
          </button>
        </div>

        <button
          v-if="
            hasAnswered && currentQuestion < game.questions.length - 1
          "
          class="btn-secondary"
          @click="nextQuestion()"
        >
          Question suivante
        </button>
        <div
          v-else-if="
            hasAnswered && currentQuestion === game.questions.length - 1
          "
          class="flex space-x-4"
        >
          <button class="btn-secondary" @click="showLeaderboard()">
            Voir le leaderboard
          </button>
          <button class="btn-warning" @click="endGame()">
            Fin de la partie
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GameComponent',
  props: {
    game: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      currentQuestion: 0,
      score: 0,
      hasAnswered: false,
    }
  },
  methods: {
    checkAnswer(answer) {
      this.hasAnswered = true
      if (answer.is_correct) this.score++
    },
    nextQuestion() {
      this.hasAnswered = false
      if (this.currentQuestion < this.game.questions.length - 1)
        this.currentQuestion++
    },
    endGame() {
      this.$emit('endGame')
    },
    showLeaderboard() {
      this.$router.push('/leaderboard')
    },
  },
}
</script>