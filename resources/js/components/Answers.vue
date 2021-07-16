<template>
  <div
    class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6"
    v-cloak
  >
    <h2 class="text-lg font-bold text-gray-600">
      {{ title }}
    </h2>
    <hr class="border-gray-300" />
    <div v-if="answers_count" class="answers-list">
      <answer
        v-for="answer in data"
        :answer="answer"
        :key="answer.id"
        v-on:deleted="deleteAnswer"
      />
    </div>

    <new-answer :id="data[0].question_id" @added="addNewAnswer" />
  </div>
</template>

<script>
import Answer from "./Answer.vue";
import NewAnswer from "./NewAnswer.vue";

export default {
  name: "answers",
  props: ["answers", "count"],
  components: {
    Answer,
    NewAnswer,
  },
  data() {
    return {
      data: this.answers,
      answers_count: this.count,
    };
  },
  computed: {
    title() {
      return (
        this.answers_count +
        " " +
        (this.answers_count > 1 ? "Answers" : "Answer")
      );
    },
  },
  methods: {
    deleteAnswer() {
      this.answers_count--;
    },
    addNewAnswer(answer) {
      this.answers_count++;
      this.data.push(answer);
    },
  },
};
</script>