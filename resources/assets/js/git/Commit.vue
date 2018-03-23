<template>

<tr :class="'tree-item-' + treeItem.sha">
    <td style="max-width: 320px">
        <span class="mr-2">
            <i v-if="treeItem.type === 'tree'" class="fas fa-folder"></i>
            <i v-else class="far fa-file"></i>
        </span>
        <span v-if="treeItem.type === 'tree'"><a :href="'/projects/' + projectId + '/files' + nextPath(treeItem.path, treeItem.name)" class="text-dark">{{ treeItem.name }}</a></span>
        <span v-else>{{ treeItem.name }}</span>
    </td>
    <td :class="'has-emoji'" style="max-width: 320px">
        <span v-if="done" :class="'commit-' + commit.data.hash">
            <span v-tooltip:top="commit.data.author.name">{{ commit.data.message }}</span>
        </span>
    </td>
    <td class="has-emoji text-right">
        <span v-if="done" v-tooltip:top="commit.data.created_at.date">{{ commit.data.created_at.date | moment }}</span>
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