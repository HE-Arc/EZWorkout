<template>
  <div>
    <jet-form-section>
      <template #title> Connexion depuis l'app </template>

      <template #description>
        Pour vous connecter depuis votre téléphone, scannez ce QRCode depuis
        l'application.
      </template>

      <template #form>
        <div style="text-align: center">
          <img
            src="/qrcode"
            alt="qrcode de connexion"
            width="400px"
            style="max-width: 400px"
          />
        </div>
      </template>
    </jet-form-section>
  </div>
</template>

<script>
import JetFormSection from "./../../Jetstream/FormSection";

export default {
  components: {
    JetFormSection,
  },

  props: [],

  data() {
    return {};
  },

  methods: {},
};
</script>
