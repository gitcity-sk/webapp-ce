<template>
<tr>
    <td><span class="mr-2"><i class="fal fa-box-alt"></i></span><a :href="'/spaces/' + spaceData.slug" style="font-weight: 600" class="text-dark">{{ spaceData.name }}</a></td>
    <td><span v-if="done"> {{ space.data.human_readable_size }} </span></td>
    <td class="text-right">
        <span v-tooltip:left="'Private space - To access is need verification.'" v-if="spaceData.private == 1"><i class="far fa-lock-alt"></i></span>
        <span v-tooltip:left="'Public space - Can be acessed without verifiaction.'" v-else><i class="fal fa-globe"></i></span>
    </td>
</tr>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';

    export default {
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['spaceData'],
        data () {
            return {
                done: false,
                space: null,
                errors: []
            }
        },
        created () {
            axios.get('/api/spaces/' + this.spaceData.id + '/size')
            .then(response => {
                this.space = response.data
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>