export const email = (email) => {
  let regexp =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regexp.test(String(email).toLowerCase());
};

export const required = (field) => {
  return (
    field !== undefined &&
    field !== null &&
    field !== "" &&
    field !== [] &&
    field !== false
  );
};

export const same = (val1, val2) => {
  return val1 === val2;
};

export const fromList = (val, list, col = "id") => {
  return list.filter((e) => e[col] === val).length > 0;
};

export const url = (val) => {
  return (
    val.match(
      /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)/g
    ) !== null
  );
};

export const number = (val) => {
  return !isNaN(val);
};

export const optional = (val, callbacks = []) => {
  if (required(val)) {
    let r = true;
    callbacks.forEach((callback, index, arr) => {
      if (!callback(val)) {
        r = false;
        arr.length = index + 1;
      }
    });
    return r;
  }
  return true;
};
