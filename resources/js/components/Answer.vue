<script>
export default {
  name: "answer",
  props: ["answer"],
  data() {
    return {
      editing: false,
      body: this.answer.body,
      bodyHtml: this.answer.body_html,
      id: this.answer.id,
      questionId: this.answer.question_id,
      beforeEditCache: null,
    };
  },
  methods: {
    edit() {
      this.beforeEditCache = this.body;
      this.editing = true;
    },
    cancel() {
      this.body = this.beforeEditCache;
      this.editing = false;
    },
    update() {
      axios
        .patch(this.endpoint, {
          body: this.body,
        })
        .then((res) => {
          if (res.status == 200) {
            this.editing = false;
            this.bodyHtml = res.data.body_html;
            this.$toast.success(res.data.message, "Success", {
              position: "topRight",
              timeout: 3000,
            });
          }
        })
        .catch((err) => {
          this.$toast.success(err.response.data.message, "Error", {
            position: "topRight",
            timeout: 3000,
          });
        });
    },
    destroy() {
      this.$toast.question("Are you sure?", "Confirm", {
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        position: "center",
        buttons: [
          [
            "<button><b>YES</b></button>",
            (instance, toast) => {
              axios.delete(this.endpoint).then((res) => {
                $(this.$el).fadeOut(500, () => {
                  this.$toast.success(res.data.message, "Success", {
                    position: "topRight",
                    timeout: 3000,
                  });
                });
              });
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
            true,
          ],
          [
            "<button>NO</button>",
            (instance, toast) => {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
      });
    },
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    },
    endpoint() {
      return `/questions/${this.questionId}/answers/${this.id}`;
    },
  },
};
</script>