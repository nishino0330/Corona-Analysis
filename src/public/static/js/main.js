function dateUpdate(selectGenre) {
    console.log(selectGenre);
    if (selectGenre === "weekly") {
        // weekly
        createChart_date_range(weekly);
    } else if (selectGenre === "monthly") {
        // monthly
        createChart_date_range(monthly);
    } else if (selectGenre === "half_year") {
        // half_year
        createChart_date_range(half_year);
    } else if (selectGenre === "year") {
        // year
        createChart_date_range(year);
    }
}

function createChart_date_range(dateList) {
    infected_chart = c3.generate({
        bindto: '#infected_chart',
        data: {
            x: '日付',
            xFormat: '%Y-%m-%d',
            columns: [
                dateList,
                AllGraph,
                TokyoGraph,
            ]
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%m月%d日'
                },
                label: {
                    text: '日付',
                    position: 'outer-middle'
                }
            },
            y: {
                label: {
                    text: '新規感染者数',
                    position: 'outer-middle'
                }
            }
        }
    });

    deceased[0] = dateList;
    deceased_chart = c3.generate({
        bindto: '#deceased_chart',
        data: {
            x: '日付',
            xFormat: '%Y-%m-%d',
            columns: deceased, /* [
                dateList,
                every_other_day['AllGraph'],
                every_other_day['TokyoGraph'], 
            ] */
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%m月%d日'
                },
                label: {
                    text: '日付',
                    position: 'outer-middle'
                }
            },
            y: {
                label: {
                    text: '死亡者数',
                    position: 'outer-middle'
                }
            }
        }
    });
}

function createChart_deceased_display(intervallist) {
    console.log(intervallist);
    deceased[1] = intervallist['AllGraph'];
    deceased[2] = intervallist['TokyoGraph'];
    deceased_chart = c3.generate({
        bindto: '#deceased_chart',
        data: {
            x: '日付',
            xFormat: '%Y-%m-%d',
            columns: deceased, /*[
                weekly,
                every_other_day['AllGraph'],
                every_other_day['TokyoGraph'],
            ] */
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%m月%d日'
                },
                label: {
                    text: '日付',
                    position: 'outer-middle'
                }
            },
            y: {
                label: {
                    text: '死亡者者数',
                    position: 'outer-middle'
                }
            }
        }
    });
}

var infected_chart = c3.generate({
    bindto: '#infected_chart',
    data: {
        x: '日付',
        xFormat: '%Y-%m-%d',
        columns: [
            weekly,
            AllGraph,
            TokyoGraph,
        ]
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%m月%d日'
            },
            label: {
                text: '日付',
                position: 'outer-middle'
            }
        },
        y: {
            label: {
                text: '新規感染者数',
                position: 'outer-middle'
            }
        }
    }
});

/// ----------------------

function intervalUpdate(selectGenre) {
    console.log(selectGenre);
    if (selectGenre === "every_other_day") {
        // every_other_day
        createChart_deceased_display(every_other_day);
    } else if (selectGenre === "Cumulative") {
        // Cumulative
        createChart_deceased_display(Cumulative);
    }
}

var deceased_chart = c3.generate({
    bindto: '#deceased_chart',
    data: {
        x: '日付',
        xFormat: '%Y-%m-%d',
        columns: deceased, /* [
            weekly,
            every_other_day['AllGraph'],
            every_other_day['TokyoGraph'],
        ] */
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%m月%d日'
            },
            label: {
                text: '日付',
                position: 'outer-middle'
            }
        },
        y: {
            label: {
                text: '死亡者数',
                position: 'outer-middle'
            }
        }
    }
});

