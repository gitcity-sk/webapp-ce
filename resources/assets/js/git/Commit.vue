<template>

<tr>
    <td style="max-width: 320px">
        <span class="mr-2">
            <i v-if="treeItem.type === 'tree'" class="fas fa-folder"></i>
            <i v-else class="far fa-file"></i>
        </span>
        <span v-if="treeItem.type === 'tree'"><a :href="'/projects/' + projectId + '/files' + nextPath(treeItem.path, treeItem.name)">{{ treeItem.name }}</a></span>
        <span v-else>{{ treeItem.name }}</span>
    </td>
    <td class="has-emoji" style="max-width: 320px">
        <span v-if="done"><strong>{{ commit.data.author.name }}</strong> {{ commit.data.message }}</span>
    </td>
    <td class="has-emoji">
        <span v-if="done">{{ commit.data.created_at.date | moment }}</span>
    </td>
</tr>

</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'

    export default {
        props: ['projectId', 'commitSha', 'treeItem'],
        mounted () {
            console.log('Component TreeTableComponent mounted.')
        },
        data () {
            return {
                done: false,
                commit: null,
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/commits/' + this.commitSha)
            .then(response => {
                this.commit = response.data

                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        },
        methods: {
            nextPath: function(path, fileName) {
                // for root paths return filename with slash
                if (path == "") return '/' + fileName;

                //for all other paths return current path + filename
                if (path != "") return '/' + path + '/' + fileName;
            }
        }
    }
</script>