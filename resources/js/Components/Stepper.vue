<script setup>
import { defineProps,ref, onMounted, nextTick, onBeforeUnmount, computed } from 'vue';

const props = defineProps({
	value: {
		type: Array,
		required: true
	},
	currentStep: {
		default: 1
	}
});

const emit = defineEmits([
	'update:currentStep'
])

const currentStepComputed = computed(() => {
	return props.currentStep + 1
})

const steps = ref([]);
const pBarSize = ref('');
// const currentStep = ref(1);

onMounted(() => {
	if (!props.value || props.value.length == 0) {
		return;
	}

	steps.value = props.value
		.map((s, i) => ({ number: i+1, selected: false, ...s}) );

	steps.value[0].selected = true;

	nextTick(() => {
		calculateBarPosition();
	});

	window.addEventListener('resize', calculateBarPosition);
});

onBeforeUnmount(() => {
	window.removeEventListener('resize', calculateBarPosition);
});

const progress = computed(() => {
	if (currentStepComputed > steps.value.length) {
		return `width: 100%`;
	}
	const first = document.getElementById('step-1');
	const current = document.getElementById(`step-${currentStepComputed}`);
	if (first && current) {
		const delta = current.getBoundingClientRect().right -first.getBoundingClientRect().right;
		return `width: ${delta}px;`;
	}
});

const moveStep = (stepNumber) => {

	if(stepNumber > currentStepComputed.value){
		return
	}
	
	if (stepNumber > steps.value.length) {
		return;
	}
	emit("update:currentStep", stepNumber -1)
};

const calculateBarPosition = () => {
	let docEl = document.documentElement;
	const first = document.getElementById('step-1');
	let rect = first.getBoundingClientRect();
	const offset = rect.left + (window.pageXOffset || docEl.scrollLeft || 0);
	const top = rect.top + rect.height/2 - 2;
	pBarSize.value = `left: ${offset}px; right: ${offset}px; top: ${top}px`;
};

</script>

<template id="vue-stepper">
	<div>
		<div class="flex-container">
			<div class="progress" :style="pBarSize">
				<div class="progress-bar"
					role="progressbar"
					aria-valuenow="60"
					aria-valuemin="0"
					aria-valuemax="100"
					:style="progress"
				>
				</div>
			</div>
			<div 
				class="step w-10"
				v-for="(step, i) in steps"
				:key="i"
				:class="{ done: step.number < currentStepComputed, current: step.number === currentStepComputed }"
			>
				<div 
					class="step-number"
					:id="'step-'+step.number"
					v-on:click="moveStep(step.number)"
				>

					<svg v-if="step.number < currentStepComputed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-ey-black">
						<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
					</svg>

					<span 
						v-else
						class="font-bold"
						:class="{ 'text-ey-black': step.number === currentStepComputed }"
					>
						{{step.number}}
					</span>
				</div>
				<div class="step-label">{{step?.label ?? ""}}</div>
			</div>
		</div>

		<div class="container">

			<slot></slot>

		</div>
	</div>
</template>

<style>
	/* vue-stepper styling */
.flex-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 1em;
}
.flex-container .progress {
  position: absolute;
  top: 2em;
  height: 5px;
  margin: 0;
  box-shadow: none;
  background-color: #cdcdcd;
}
.flex-container .progress .progress-bar {
  background-color: #ffe600;
}
.flex-container .step {
  text-align: center;
  z-index: 2;
}
.flex-container .step .step-number {
  background-color: #2e2e38;
  padding: 0.5em;
  color: white;
  border-radius: 2em;
  background-size: 0% 0%;
  background-position: center;
  background-image: radial-gradient(circle at center, #ffe600 50%, transparent 50%);
  background-repeat: no-repeat;
}
.flex-container .step.current .step-number {
  background-size: 200% 200%;
  transition: all 0.4s 0.5s;
}
.flex-container .step.done .step-number {
  background-color: #ffe600;
}
.flex-container .step .step-label {
  padding-top: 5px;
}
</style>
