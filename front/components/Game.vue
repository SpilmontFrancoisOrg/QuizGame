<template>
  <div class="space-y-6">
    <div class="card flex-row justify-evenly py-4">
      <span class="text-2xl font-semibold">Partie en cours</span>

      <span class="text-xl font-semibold"> Score : {{ score }} </span>

      <span class="text-xl font-semibold">
        Question {{ currentQuestion + 1 }} sur
        {{ currentGame.questions.length }}
      </span>
    </div>

    <div class="card p-4">
      <div class="flex flex-col space-y-4">
        <span class="text-xl font-semibold text-center">
          {{ currentGame.questions[currentQuestion].question.name }}
        </span>

        <div class="grid grid-cols-2 gap-4">
          <button
            v-for="(answer, index) in currentGame.questions[currentQuestion]
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
            hasAnswered && currentQuestion < currentGame.questions.length - 1
          "
          class="btn-secondary"
          @click="nextQuestion()"
        >
          Question suivante
        </button>
        <button
          v-else-if="
            hasAnswered && currentQuestion === currentGame.questions.length - 1
          "
          class="btn-warning"
          @click="endGame()"
        >
          Fin de la partie
        </button>
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
      currentGame: this.game,
      currentQuestion: 0,
      score: 0,
      hasAnswered: false,
    }
  },
  methods: {
    checkAnswer(answer) {
      this.hasAnswered = true
      if (answer.is_correct) this.score++

      if (this.currentQuestion < this.currentGame.questions.length - 1)
        this.currentQuestion++
    },
    nextQuestion() {
      this.hasAnswered = false
      this.currentQuestion++
    },
    endGame() {
      this.$emit('endGame')
    },
  },
}
</script>