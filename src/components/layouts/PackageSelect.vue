<template>
    <label class="package" :class="{ 'checked': isChecked }" >
        <input
            type="checkbox"
            :checked="isChecked"
            @change="$emit('select', pack.id)"
            v-model="isChecked"
            :disabled="isDisabled"
          >
          <span></span>
          <div class="package-info">
            <p>{{ pack.name }}</p>
            <p class="price" :class="{ 'checked': isChecked }" ><inline>$</inline>{{ pack.price }}</p>
          </div>
    </label>
</template>

<script>
export default {
  data() {
    return {
      Checked: false
    }
  },

    props: {
        pack: {
            type: String,
            default: ''
        },
        modelValue: {
            type: Boolean,
            default: false
        },
        selectedPackages: {
          type: Array,
          default: () => []
        }
    },
  emits: ['select'],
  computed: {
    isChecked() {
      return this.selectedPackages.includes(this.pack.id) && this.modelValue
    },
    isDisabled() {
      return this.selectedPackages.includes(this.pack.id);
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/sass/_globals/_variables.scss";
.checked {
  background-color: $primary;
  color: white;
}
.package {
  display: flex;
  flex-direction: row;
}
.package-info{
  display: flex;
  flex-direction: column;
  margin-left: 4px;
  align-items: center;
  justify-content: space-between;
  width: 80%;
}
.package-info:first-of-type {
  font-size: 0.8rem;
}
.price{
  position: relative;
  color: $dark;
  font-size: larger;
  font-weight: 600;
  font-size: 1.8rem;
  line-height: 1rem;
}
inline{
  position: absolute;
  font-size: 0.8rem;
  top: 0;
  left: -7px;
  line-height: 0.8rem;
}
label {
  color: $gray;
  text-transform: uppercase;
  background-color: $light-gray;
  margin: 5px ;
  padding: 5px;
  max-width: 180px;
  height: 100px;
  border-radius: 5px;
  text-align: center;
  border: 1px solid $gray-50;
  cursor: pointer;
  user-select: none;
  transition: all linear 0.3s;

  span {
    margin: 0 3px;
    transition: all linear 0.3s;
  }

  span:first-of-type {
    width: 16px;
    height: 16px;
    border: 1px solid;
    border-color: $gray;
    display: inline-block;
    border-radius: 50%;
    position: relative;
    top: 3px;

    &:after {
      content: "";
      position: absolute;
      top: calc(25% - 1px);
      left: 6px;
      border-bottom: 2px solid white;
      border-right: 2px solid white;
      height: 8px;
      width: 4px;
      transform: rotate(45deg);
      visibility: hidden;
      transition: all linear 0.3s;
      opacity: 0;
    }
  }

  input {
    display: none !important;
    &:checked ~ .package-info p {
      color: white;
    }
    &:checked ~ span {
      border-color: white;
      background-color: $primary;
      color: white;
      &:after {
        visibility: visible;
        opacity: 1;
      }
    }
  }
}

</style>