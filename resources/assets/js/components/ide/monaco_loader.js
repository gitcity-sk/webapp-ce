import monacoContext from 'monaco-editor/dev/vs/loader';

monacoContext.require.config({
    paths: {
        vs: 'public/js/vs'
    },
});

window.__monaco_context__ = monacoContext;
export default monacoContext.require;