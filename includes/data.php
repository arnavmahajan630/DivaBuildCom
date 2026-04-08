<?php

declare(strict_types=1);

$navItems = [
    ['label' => 'Home', 'href' => site_url(), 'page' => 'home'],
    ['label' => 'About', 'href' => site_url('about.php'), 'page' => 'about'],
    ['label' => 'Services', 'href' => site_url('services.php'), 'page' => 'services'],
    ['label' => 'Projects', 'href' => site_url('/#projects'), 'page' => 'projects'],
    ['label' => 'Careers', 'href' => site_url('careers.php'), 'page' => 'careers'],
    ['label' => 'Contact', 'href' => site_url('contact.php'), 'page' => 'contact'],
];

$homeStats = [
    ['value' => '08', 'label' => 'Total Projects'],
    ['value' => '04', 'label' => 'Completed'],
    ['value' => '04', 'label' => 'Ongoing'],
    ['value' => '100%', 'label' => 'Client Satisfaction'],
];

$homeValues = [
    ['title' => 'Quality Work', 'copy' => 'We never compromise on material quality or construction standards, ensuring long-term project reliability.'],
    ['title' => 'Timely Delivery', 'copy' => 'Clear scheduling, disciplined execution, and transparent communication keep projects moving on time.'],
    ['title' => 'Experienced Team', 'copy' => 'Our team is led by civil engineering professionals with real site experience across Mumbai.'],
    ['title' => 'Mumbai Expertise', 'copy' => 'We understand suburban terrain, local approvals, and the realities of building in the MMR region.'],
];

$processSteps = [
    ['title' => 'Planning', 'copy' => 'Consultation, site analysis, and detailed cost estimation.'],
    ['title' => 'Design', 'copy' => 'Architectural drafting and structural engineering blueprints.'],
    ['title' => 'Execution', 'copy' => 'Disciplined construction with strict quality control on every milestone.'],
    ['title' => 'Delivery', 'copy' => 'Final inspections, snag closure, and smooth project handover.'],
];

$capabilities = [
    ['title' => 'Residential', 'copy' => 'Luxury villas, apartment clusters, and premium suburban housing projects.', 'icon' => 'Residential'],
    ['title' => 'Commercial', 'copy' => 'Office, retail, and developer-focused commercial infrastructure that scales.', 'icon' => 'Commercial'],
    ['title' => 'Renovation', 'copy' => 'Structural restoration and modern upgrades for both new-age and legacy assets.', 'icon' => 'Renovation'],
    ['title' => 'M&E Services', 'copy' => 'Reliable plumbing and electrical systems using industrial-grade execution standards.', 'icon' => 'M&E'],
];

$featuredProjects = [
    [
        'category' => 'Corporate Hub',
        'title' => 'The Zenith Plaza',
        'location' => 'Borivali, Mumbai',
        'status' => 'Completed',
        'copy' => 'A 12-storey commercial landmark with sustainable glazing, efficient structural systems, and clean contemporary detailing.',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDH4Ewc6MZ0rF1Sq-8ObNiwb_nL7NMGPl2Do4I9wa3flx7M6NF04qMQchRJrlrxA5u5J_8tEb24Hcb-I8VwZBN3d2ZcYE5Ry5nj9RvpP7kV5qpj1hWuUBsjjtLXQLoeOm8BtF6APeu_yOPCHI6JEvxH4BprCu83Y_RJ6MHolAtcICb777oC7XKH1I1_LIuLdQtzkrGCL0hV16oQIomeI5I4hgAr8unML5hUOXa5tfeg1JjK0idyGODVOBgu9Z2bNlCAVXQRlSQ1vLe5',
    ],
    [
        'category' => 'Residential',
        'title' => 'Amber Heights',
        'location' => 'Kandivali, Mumbai',
        'status' => 'In Progress',
        'copy' => 'A premium residential development balancing seismic stability, open planning, and strong construction discipline.',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBNSGJ9h0NXOcjxOq0OlaPz8rqqloA0nn7K_386VGnXC_AMBSSNn-OFXIkxg0A2puyQbqNSwPq_wXCzMHYe_wEP-UmgguWFYV3OybwmjYddyFeQrkvpw3LDTizrSRk6wdrQBbS08D3LBpVCdxzJ9j4ZNDVJss2LTT8Iolm7KpNqJLpxmSdVR6mVrn_gGnlDtzLM6hKuveD8Gy0BJRuaFXIubXRg55_Ydy3Jn20QR4Bqv6S21ShanQSlwCRFnStt6toDCLbXbS_IDS2r',
    ],
    [
        'category' => 'Industrial',
        'title' => 'Malad Logistics Park',
        'location' => 'Malad East, Mumbai',
        'status' => 'Completed',
        'copy' => 'Heavy-duty warehouse infrastructure built with durable flooring, efficient spans, and a fast site delivery cycle.',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBMaF1ptdlihy3WEmXA_jpby0VGQ7aXHwG5DpbpEy98Rqv7oJ5u-186Pmq7xoyHi1KPx5PXS1QDJIC-dEhsU7zcU-qqaVDOt0R62Xbsp_Aw9tIMlpk8DgG-EuZDuiScXra7P8yNnz33bp-mPzAzrZuNn24x6Grr2J9cB4LCTOW_ojqAEyNjHZv84DZuHRokxYbzmyn18rIHQbHrLsa6qGHx08MJGl1Wx_6I2sbzv0n-hAkXTLnIENEMwpXNnfhRhacA9dQOkG2djw4K',
    ],
];

$testimonials = [
    ['initials' => 'RK', 'name' => 'Rajesh Kulkarni', 'role' => 'Developer, Borivali', 'copy' => 'Diva Buildcom delivered our residential complex ahead of schedule and handled site execution with discipline from day one.'],
    ['initials' => 'SM', 'name' => 'Sanjay Mehta', 'role' => 'Property Owner, Bandra', 'copy' => 'Their renovation team strengthened a difficult structure without losing the design character of the property.'],
    ['initials' => 'AP', 'name' => 'Anita Patil', 'role' => 'MD, Logistics Firm', 'copy' => 'The team understood regulations, ground realities, and warehousing requirements better than most contractors we evaluated.'],
];

$services = [
    [
        'title' => 'Residential Construction',
        'copy' => 'Crafting bespoke living environments that merge architectural aesthetics with structural integrity and execution quality.',
        'bullets' => ['Advanced seismic-resistant methods', 'Solar-ready planning and efficient services'],
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCiKb3s9yyMl21Jrah8RerzrB43ivRydavtb0Il36gPq3z95--bP5O4PviGf_DLniZxSWXl9l84ypRfSK65HwSPw6YkcqyjzKw9j83sTWM7XqojfgGBUsGRMn2EBcKiY6jYSmg7TZ2L0GDJpQpKYk_Jkil81_tibZLXvKF39LUuyeq3a1HI8zUl6wFB5qedDIePLFigsIG_tyxm1vmqajudqBhBKOEibi6_n7AuzhWAvdvsaDJOQaBxq1TmwzJxpuCdlu_By6ONtiso',
        'reverse' => false,
    ],
    [
        'title' => 'Commercial Construction',
        'copy' => 'Powering business growth through robust office, retail, and mixed-use construction tailored for high-performance occupancy.',
        'bullets' => ['Flexible spatial planning', 'Fast-track coordination for developer timelines'],
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAI4T96LnFdqSYbx9y2Ypwf09STteWsdUOW3zpIPtn9nxq4k7ApwxjTBxXNs7ywzfCHP_-bREJ1DGFb7-3PZKrx9Isrx-hPIK2pOnv8R9Eqjm8H-tAktVo-tbpF6DxTU9gSs_osTOFsuhJTGQ6iaAo2m9msP2UssOGDv5--bZt5iwoO3ip-jpwPTrn38SBvCW4hPwSRytSVO2Tob_F4Pmk1H5_6HrxmFzAYVaDGt_-nJD_9vC-3EXy7qP9L8EZIyNZsyVeHSQz_pL3t',
        'reverse' => true,
    ],
    [
        'title' => 'Renovation & Interior Work',
        'copy' => 'Reimagining existing spaces with structural upgrades, aesthetic refinements, and site-sensitive craftsmanship.',
        'bullets' => ['Adaptive renovation strategy', 'High-end finishes with functional planning'],
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXPW2xazl2Tb9gtr-ggPQd2Hq9yneMoGZWld61o4uRaoIej9coqXiSlH9W3zaW6Hb1nbBRHi3sQWhC2zN8UQz_J73o-KWb8QFhhoPM7evUvo_tUXCMShLSAnYtclXT3U-kK2XvQVwr7crBh4lSDBjzB_r17YtKNyMvPVjwgBaL1gZVHhcLNdOsUCJTyRNF-UglRkfbZ6rUOeZHQqgZ1BGHU19_fCQ-1AVxe0yV1EjeI1QfMbp0oCoh92j5hwW-m-JB5brsyjsLqb0C',
        'reverse' => false,
    ],
    [
        'title' => 'Plumbing & Electrical',
        'copy' => 'Integrated building services with dependable installation quality, maintenance access, and safe long-term performance.',
        'bullets' => ['MEP service coordination', 'Reliable utility systems'],
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBxdhBW4_PaWAFPBEparb-_ESHFdlUmpOCRoBprrCzn8nOCIsgMuHN79y23VLAOGertHweLYMCYJmAMqDnfSbEMNcFjogj4jphfeebe5IcAHWpWe0EdnsXWHaAjuO7rdOYNAciyCLkOskeXgGyfGEdDlvY_8nF5FTPvw9lTqkylEEA8z2y1MHt-UXpeBvgK3jLAJw7A87c4-5VkofDCrC8zbLuoQ2gQVgWtfgoaD14NCvrzCn8906Qsp6SkYUZImnxcSB4Ea1MSb44I',
        'reverse' => true,
    ],
];

$teamMembers = [
    ['name' => 'Arjun Mehta', 'role' => 'Lead Engineer', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA4hDmZ5k0KYKFGhFPZjf2jrakQ3Y-bXI4GK26bx7-t7KgknqMSJ4XlNDt69uXN0rO2veF53UiDAB9XU6xn_XgB-qxL4_NAIFKR6coUHGTUpTKomzzHhh2YBGHw6s-MMgV7aPcBUAElb9r_s5T5AgbV80BToOzbv6jHI-69qibnzt7x4wp_KrRKoXBtky4heh2_zWN1a_J5x-USOKaTnv_vcfDux7S74JJZLZP_WPNPbKurmf0_hR68bflz4wgRvBe4LpLYVa5wO3pi'],
    ['name' => 'Sanya Iyer', 'role' => 'Project Manager', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDd7OyANoWf9PEJxa5X2paQp5_mvKyWfVl0M7agf8KdnXOalkjcOWNWINVoPcjWGi3AkLwdNSBW78EKIvedKq6u5eWxsz4Jzg_EWJzYrhAi6BDBeYCP-JpNr8Lnp4Kz8x-ka-da4Mlv2LTt5hdeYs4VhnG3LtC9BHTYFPf1ZMNVteOqEa19omHNmq-8FzMZAADGRV4Mjfho15EHVCWacYTY2QmVWcpSc21lsKlEY4XsUR3xodE1Fx1b21TW4eZCUC_ZLfKJk4mE2Q4_'],
    ['name' => 'Rohan Desai', 'role' => 'Site Supervisor', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBblcJddEiPlL6KKPPCcdDCPjZzcgzk71GWT1uVFGP-PZqPOH9zr2IxLrUC70-GkN5CsQmFCa5I0Kcdk54mpGBMcOTofzOKpoiMaesuiFZgCfPM76MT6PBeXvVDANbvLgFJs-uIaD9buePedM301x9BlYmriGnax5vlW5ew_m62QB1BLUmFVUzk6Dn5EFQEE0gr6Dtj_2Vy5DXYxMG55OTGlJko5XxpNLYDu1TMydpt1zdhNHgYwZ6BnHomGY5nL6bH8MAY-lI7ReJU'],
    ['name' => 'Vikram Singh', 'role' => 'Site Supervisor', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBMpi50HVwEQjClsIKCZHH6fyAlAcs29VhxaQA6IlwpumSbHE_wYZIpYBgWTsea-O8wkhqHkjcTVuwB0oZ9Vetve5nPpOMtJe-_djj7PrpqqiT_ejKtJDMtnF8aN8_QEyaiG1ogaW356k8hO-dJBZE7gBzWVp55Ee8sKXbU__yJ01SFxkaUrgy_dwUnUZXgxr6JaZuL_YcMzVXTreIK0vjD7hhPc6CR_EtDvTfFsN17zndqbEHtTylklIw3CN48xY83aO73cj3diZBk'],
];

$legacyOpenings = [
    [
        'title' => 'Site Engineer',
        'location' => 'Suburban Mumbai',
        'experience' => '1-3 Years',
        'type' => 'Full-Time',
        'summary' => 'Drive site coordination, measurement checks, and execution quality across active Mumbai projects.',
        'sort_order' => 1,
    ],
    [
        'title' => 'Project Manager',
        'location' => 'Mumbai',
        'experience' => '3-5 Years',
        'type' => 'Full-Time',
        'summary' => 'Own project planning, reporting, contractor alignment, and milestone delivery for premium builds.',
        'sort_order' => 2,
    ],
    [
        'title' => 'Interior Designer',
        'location' => 'Mumbai',
        'experience' => '1-3 Years',
        'type' => 'Full-Time',
        'summary' => 'Translate client goals into refined interior concepts with practical coordination for site execution.',
        'sort_order' => 3,
    ],
    [
        'title' => 'Electrical Technician',
        'location' => 'Suburban Mumbai',
        'experience' => '1-2 Years',
        'type' => 'Full-Time',
        'summary' => 'Support safe and reliable electrical installation work with disciplined on-site execution standards.',
        'sort_order' => 4,
    ],
];

$benefits = [
    'Competitive salary packages',
    'Hands-on site experience',
    'Continuous skill development',
    'Growth and leadership opportunities',
    'Supportive work culture',
];

$faqItems = [
    [
        'question' => 'How long does construction take?',
        'answer' => 'Timelines vary by project size and approvals, but we provide a detailed milestone plan after the initial site and scope review.',
    ],
    [
        'question' => 'What areas do you serve?',
        'answer' => 'We primarily work across suburban Mumbai and selected premium projects within the wider MMR region.',
    ],
    [
        'question' => 'Do you provide design services?',
        'answer' => 'Yes. We support design-build workflows through coordinated planning, engineering, and execution support.',
    ],
];

$contactGallery = [
    'https://lh3.googleusercontent.com/aida-public/AB6AXuBRY49MOpzZgX4ChyJi7e_kGx8bEoo6TtV7eBPAsKPZ1mHgwXKOV2z_KFlMSnBZHLrybXEztNco0JRbVfBe-HHA56fMI32qzZAs37bBU5yUrcmzozbARe6bhzJ3xz1Qbw8hKtMqmskqMUyROa1FCHg14PEu66ct7dE9FQSgSS9Y_6JTtEYwd0ecJ7JlUhzXzzXlWfKGKeh1gt2JyEehyZghEN89YIVfXCz4t8YYbZtklVzK-K1Zkd_6zWqlH00QO6OpbgULlS6L24XM',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuBL49Gd4WBojvPOWBsHBFznuVncWuFcGj1k7A7Oj0JhkPFoj1nfpaEFG4SXxnookXpZSp19y2rf-KeF0-LWdyYxSAcBfjotBhDKtHHyLmcTPGJe4jtyR3KS0tqil_pa46S4dA-0o8KFt0XJ6ItgjcZusbpAsVolLwd0Klg8fF2Pv4W2lrkgNmW8qUqkKXF3J-m5Us1fQ5U_L9Hn_DQr5tE66jghoI2p5mC2h0IbSifkLfp84VNIMv-cZnwYAL-i2OKrUM7UGOFilsAg',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuC0u-0gBsumum7Q9wSnMWmyYLKZjRcsLgh6pg0mrzaXZhMGiuY1rqTT_Mej7ATjny0G1lBlS2iEku6tdo0JHcRc9RlFZxFc1e5X9rk793kwoqcQ3eItBsXM5QMPPCQvWSvKOcNjS-e-TNZox3oUQsmkGLMp3e4xDjfB4t6Bziu9s5_EEE1qMeYreMAdbuq2xakhJudtA-vV9SafsB04HPOb2g-cCSkovk0lLqP9MiX06BRPOGvOV9b9GfXKYD9uo-51kNiPbo-5-UUj',
];

function legacy_openings(): array
{
    return $GLOBALS['legacyOpenings'] ?? [];
}
