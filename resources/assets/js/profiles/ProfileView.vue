<template>
<div v-if="done" class="col-md-12 text-center">
    <img :src="profile.data.image" :alt="profile.data.name" class="img-thumbnail rounded-circle" height="120px" width="120px">
    <h2 style="font-weight: 300" class="has-emoji">{{ profile.data.name }}</h2>
    {{ profile.data.twitter }}
    {{ profile.data.facebook }}
    <p class="lead">{{ profile.data.description | with_emoji }}</p>
</div>
</template>

<script>
import axios from 'axios'
export default {
    props: ['profileId'],
    data () {
        return {
            done: false,
            profile: {
                data: []
            },
            erros: []
        }
    },
    created () {
        axios.get('/api/profiles/' + this.profileId )
        .then(response => {
            this.profile = response.data
            this.done = true
        })
        .catch(e => {
            this.errors.push(e)
        })
    }
}
</script>