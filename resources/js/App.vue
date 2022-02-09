<template>
  <div class="container p-6 has-background-light has-text-dark">
    <h1 class="title is-1">Tournament</h1>

    <div class="panel is-info" v-for="team in teams" :key="team.name">
      <div class="panel-heading">
        <p class="has-text-weight-bold has-text-light">
          Team {{ team.name }}
        </p>
      </div>
      <div class="panel-block has-background-white">
        <div class="is-flex is-flex-direction-column content">
          <h4 class="title is-4">{{ team.players.length }} Players</h4>
          <h5 class="subtitle is-6">Ranking {{ team["ranking"] }}</h5>
          <div class="columns is-multiline">
            <div
              class="column is-full is-6-tablet is-3-desktop"
              v-for="player in team.players"
              :key="JSON.stringify(player)"
            >
              {{ player.first_name }} {{ player.last_name }}
              <span v-if="player.can_play_goalie">🥅</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
export default {
  setup() {
    const teams = ref([]);
    const loading = ref(true);

    const fetchData = async () => {
      // Missing error handling
      loading.value = true;
      const response = await fetch("/api/tournament");
      const data = await response.json();
      teams.value = data.teams;
      loading.value = false;
    };

    onMounted(() => {
      fetchData();
    });

    return {
      teams,
      loading,
    };
  },
};
</script>

<style>
</style>