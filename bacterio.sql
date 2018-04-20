--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: disp_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.disp_prelev (
    id integer NOT NULL,
    dispositif character varying(50) NOT NULL,
    condition character varying(50)
);


ALTER TABLE public.disp_prelev OWNER TO thomas;

--
-- Name: disp_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.disp_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.disp_prelev_id_seq OWNER TO thomas;

--
-- Name: disp_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.disp_prelev_id_seq OWNED BY public.disp_prelev.id;


--
-- Name: jours_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.jours_prelev (
    id integer NOT NULL,
    jour character varying(10) NOT NULL
);


ALTER TABLE public.jours_prelev OWNER TO thomas;

--
-- Name: jours_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.jours_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jours_prelev_id_seq OWNER TO thomas;

--
-- Name: jours_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.jours_prelev_id_seq OWNED BY public.jours_prelev.id;


--
-- Name: limites_classes; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.limites_classes (
    id integer NOT NULL,
    classe character varying(10) NOT NULL,
    type character varying(50) NOT NULL,
    limite integer NOT NULL
);


ALTER TABLE public.limites_classes OWNER TO thomas;

--
-- Name: limites_classes_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.limites_classes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.limites_classes_id_seq OWNER TO thomas;

--
-- Name: limites_classes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.limites_classes_id_seq OWNED BY public.limites_classes.id;


--
-- Name: planning_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.planning_prelev (
    id_jour integer NOT NULL,
    id_point integer NOT NULL
);


ALTER TABLE public.planning_prelev OWNER TO thomas;

--
-- Name: points_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.points_prelev (
    id integer NOT NULL,
    id_disp integer NOT NULL,
    id_class integer NOT NULL
);


ALTER TABLE public.points_prelev OWNER TO thomas;

--
-- Name: points_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.points_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.points_prelev_id_seq OWNER TO thomas;

--
-- Name: points_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.points_prelev_id_seq OWNED BY public.points_prelev.id;


--
-- Name: prelevements; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.prelevements (
    id integer NOT NULL,
    fait boolean NOT NULL,
    date_prelev date NOT NULL,
    id_point integer NOT NULL
);


ALTER TABLE public.prelevements OWNER TO thomas;

--
-- Name: prelevements_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.prelevements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prelevements_id_seq OWNER TO thomas;

--
-- Name: prelevements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.prelevements_id_seq OWNED BY public.prelevements.id;


--
-- Name: resultats; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.resultats (
    id integer NOT NULL,
    date_res date NOT NULL,
    tel boolean,
    nb_micro integer NOT NULL,
    micro character varying(100),
    id_prelev integer NOT NULL
);


ALTER TABLE public.resultats OWNER TO thomas;

--
-- Name: resultats_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.resultats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resultats_id_seq OWNER TO thomas;

--
-- Name: resultats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.resultats_id_seq OWNED BY public.resultats.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.disp_prelev ALTER COLUMN id SET DEFAULT nextval('public.disp_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.jours_prelev ALTER COLUMN id SET DEFAULT nextval('public.jours_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.limites_classes ALTER COLUMN id SET DEFAULT nextval('public.limites_classes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev ALTER COLUMN id SET DEFAULT nextval('public.points_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.prelevements ALTER COLUMN id SET DEFAULT nextval('public.prelevements_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.resultats ALTER COLUMN id SET DEFAULT nextval('public.resultats_id_seq'::regclass);


--
-- Data for Name: disp_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.disp_prelev (id, dispositif, condition) FROM stdin;
\.


--
-- Name: disp_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.disp_prelev_id_seq', 1, false);


--
-- Data for Name: jours_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.jours_prelev (id, jour) FROM stdin;
1	lundi
2	mardi
3	mercredi
4	jeudi
5	vendredi
\.


--
-- Name: jours_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.jours_prelev_id_seq', 5, true);


--
-- Data for Name: limites_classes; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.limites_classes (id, classe, type, limite) FROM stdin;
\.


--
-- Name: limites_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.limites_classes_id_seq', 1, false);


--
-- Data for Name: planning_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.planning_prelev (id_jour, id_point) FROM stdin;
\.


--
-- Data for Name: points_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.points_prelev (id, id_disp, id_class) FROM stdin;
\.


--
-- Name: points_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.points_prelev_id_seq', 1, false);


--
-- Data for Name: prelevements; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.prelevements (id, fait, date_prelev, id_point) FROM stdin;
\.


--
-- Name: prelevements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.prelevements_id_seq', 1, false);


--
-- Data for Name: resultats; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.resultats (id, date_res, tel, nb_micro, micro, id_prelev) FROM stdin;
\.


--
-- Name: resultats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.resultats_id_seq', 1, false);


--
-- Name: disp_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.disp_prelev
    ADD CONSTRAINT disp_prelev_pkey PRIMARY KEY (id);


--
-- Name: jours_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.jours_prelev
    ADD CONSTRAINT jours_prelev_pkey PRIMARY KEY (id);


--
-- Name: limites_classes_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.limites_classes
    ADD CONSTRAINT limites_classes_pkey PRIMARY KEY (id);


--
-- Name: planning_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.planning_prelev
    ADD CONSTRAINT planning_prelev_pkey PRIMARY KEY (id_jour, id_point);


--
-- Name: points_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_pkey PRIMARY KEY (id);


--
-- Name: prelevements_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.prelevements
    ADD CONSTRAINT prelevements_pkey PRIMARY KEY (id);


--
-- Name: resultats_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.resultats
    ADD CONSTRAINT resultats_pkey PRIMARY KEY (id);


--
-- Name: planning_prelev_id_jour_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.planning_prelev
    ADD CONSTRAINT planning_prelev_id_jour_fkey FOREIGN KEY (id_jour) REFERENCES public.jours_prelev(id);


--
-- Name: planning_prelev_id_point_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.planning_prelev
    ADD CONSTRAINT planning_prelev_id_point_fkey FOREIGN KEY (id_point) REFERENCES public.points_prelev(id);


--
-- Name: points_prelev_id_class_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_id_class_fkey FOREIGN KEY (id_class) REFERENCES public.limites_classes(id);


--
-- Name: points_prelev_id_disp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_id_disp_fkey FOREIGN KEY (id_disp) REFERENCES public.disp_prelev(id);


--
-- Name: prelevements_id_point_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.prelevements
    ADD CONSTRAINT prelevements_id_point_fkey FOREIGN KEY (id_point) REFERENCES public.points_prelev(id);


--
-- Name: resultats_id_prelev_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.resultats
    ADD CONSTRAINT resultats_id_prelev_fkey FOREIGN KEY (id_prelev) REFERENCES public.prelevements(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

