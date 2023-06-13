<template> 

    <div class="listeEnseignants"><listeEnseignants/></div>

</template>

<script>
  // @ is an alias to /src


import listeEnseignants from '@/components/listeEnseignants.vue';


export default {
    name: 'listeEnseignantsView',
    components: {

    listeEnseignants
}
  }

</script>