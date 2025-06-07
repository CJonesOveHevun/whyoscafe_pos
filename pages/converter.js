
document.addEventListener('DOMContentLoaded',function () {
    const inp = document.getElementById('inp_convert');
    const fromu = document.getElementById('fromUnit');
    const tou = document.getElementById('ToUnit');
    const output = document.getElementById('unitResults');
    const conversions = {
    'grams': {
      'grams': 1,
      'kilograms': 0.001
    },
    'kilograms': {
      'grams': 1000,
      'kilograms': 1
    },
    'liters': {
      'liters': 1,
      'milliliters': 1000
    },
    'milliliters': {
      'liters': 0.001,
      'milliliters': 1
    },
    'cups': {
      'milliliters': 240
    },
    'tablespoons': {
      'milliliters': 15
    },
    'teaspoons': {
      'milliliters': 5
    },
    'milliliters': {
      'cups': 1 / 240,
      'tablespoons': 1 / 15,
      'teaspoons': 1 / 5
    }
  };
  function convert(){
    const val = parseFloat(inp.value);
    const fromUnit = fromu.value;
    const toUnit = tou.value;
    if (!isNaN(val) && conversions[fromUnit] && conversions[fromUnit][toUnit]){
        const converted = val * conversions[fromUnit][toUnit];
        output.textContent = `${val} ${fromUnit} = ${converted.toFixed(3)} ${toUnit}`;
        console.log(converted);
    } else {
        output.textContent = 'Conversion not available';
    }
    
  }
    inp.addEventListener('input',convert);
    fromu.addEventListener('change', convert);
    tou.addEventListener('change', convert);
});