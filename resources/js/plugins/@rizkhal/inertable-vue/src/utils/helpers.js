export function ucfirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

export function formatComponentName(name) {
  const names = name.split("-");

  if (!names.length) {
    return ucfirst(name);
  }

  let x = "";
  for (let index in names) {
    if (names[index]) {
      x += ucfirst(names[index]);
    }
  }

  return x;
}
