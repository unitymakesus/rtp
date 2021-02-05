/**
 * Toggle a value of an array.
 *
 * @param array array
 * @param string value
 */
const toggleArrayValue = (array, value) => {
  let index = array.indexOf(value);
  if (index === -1) {
    array.push(value);
  } else {
    array.splice(index, 1);
  }
}

export default toggleArrayValue;
