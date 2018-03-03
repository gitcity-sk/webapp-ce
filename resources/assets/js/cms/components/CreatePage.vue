<template>
    <markdown-editor v-model="content" ref="markdownEditor" :autoinit="false"></markdown-editor>
</template>

<script>
import markdownEditor from '../../vue/shared-components/SimpleMde.vue';

export default {
    components: {
        markdownEditor
    },
    data() {
        return {
            content: 'OK',
            configs: {
                status: false,
                toolbar: ['image'],
            },
            output: '',
            type: 'markdown',
        };
    },
    computed: {
        simplemde() {
            return this.$refs.markdownEditor.simplemde;
        },
    },
    mounted() {
        this.$nextTick(() => {
            this.$refs.markdownEditor.initialize();
        });
    },
    methods: {
        handleInput(val) {
            this.output = val;
        },
        handleOutputHTML() {
            this.type = 'html';
            this.output = this.simplemde.markdown(this.content);
        },
        handleOutputMARKDOWN() {
            this.type = 'markdown';
            this.output = this.content;
        },
    },
};
</script>