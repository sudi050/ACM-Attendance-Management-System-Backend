function htmlTableToExcel(type) {
  var data = document.getElementById("tblData");
  var excelFile = XLSX.utils.table_to_book(data, { sheet: "sheet1" });
  XLSX.write(excelFile, { bookType: type, bookSST: true, type: "base64" });
  XLSX.writeFile(excelFile, "attendance-data." + type);
}
