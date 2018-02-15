<template>
    <!-- Load from webpack (note the srcPath="dist" prop) -->
    <!-- vs-dark -->
    <!--         height="600" -->
    <Monaco
        :language="language"
        srcPath="/"
        :code="code"
        :options="options"
        :highlighted="highlightLines"
        :changeThrottle="500"
        theme="vs"
        @mounted="onMounted"
        @codeChange="onCodeChange"
        >
    </Monaco>
</template>

<script>
const Monaco = require('./Monaco.vue')

module.exports = {
  props: ['language'],
  components: {
    Monaco
  },
  data() {
    return {
      code: '// type your code \n',
      highlightLines: [
        {
          number: 0,
          class: 'primary-highlighted-line'
        },
        {
          number: 0,
          class: 'secondary-highlighted-line'
        }
      ]
    };
  },
  methods: {
    onMounted(editor) {
      console.log('after mount!', editor, editor.getValue(), editor.getModel());
      this.editor = editor;
    },
    onMounted2(editor) {
      console.log('after mount!', editor, editor.getValue(), editor.getModel());
      this.editor2 = editor;
    },
    onCodeChange(editor) {
      console.log('code changed!', 'code:' + this.editor.getValue());
    },
    onCodeChange2(editor) {
      console.log('code changed!', 'code:' + this.editor2.getValue());
    },
    clickHandler() {
      console.log('here is the code:', this.editor.getValue());
    }
  },
  created() {
    this.options = {
      selectOnLineNumbers: false
    };
  }
};
</script>
