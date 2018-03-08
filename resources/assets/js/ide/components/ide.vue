<template>
    <!-- Load from webpack (note the srcPath="dist" prop) -->
    <!-- vs-dark -->
    <!--         height="600" -->
    <div style="height: 100%">
      <css-preloader :loading="done"></css-preloader>
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
    </div>
</template>

<script>
import cssPreloader from '../../vue/shared-components/css-preloader.vue';
import Monaco from './Monaco.vue';

export default {
  props: ['language'],
  components: {
    Monaco,
    cssPreloader
  },
  data () {
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
      ],
      done: false
    }
  },
  methods: {
    onMounted (editor) {
      console.log('after mount!', editor, editor.getValue(), editor.getModel());
      this.done = true;
      this.editor = editor;
    },
    onCodeChange (editor) {
      console.log('code changed!', 'code:' + this.editor.getValue());
    },
    clickHandler () {
      console.log('here is the code:', this.editor.getValue());
    }
  },
  created () {
    this.options = {
      selectOnLineNumbers: false,
      minimap: {
        enabled: false
      }
    };
  }
};
</script>
