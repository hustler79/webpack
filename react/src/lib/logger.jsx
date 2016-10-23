var dom = document.querySelector('pre');

export default function (l) {
  dom.innerHTML = l + "\n" +dom.innerHTML;
};
