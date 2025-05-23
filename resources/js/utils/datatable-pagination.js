const setTableColor = () => {
    document.querySelectorAll(".dt-paging .pagination").forEach((dt) => {
        dt.classList.add("pagination-primary");
    });
};

export default setTableColor;
