#
# makefile
#  
# Made by (François-Xavier BOIS)
# Login   <fx@inerd.fr>
#
# Started on  Tue Apr  3 22:41:44 2001 François-Xavier BOIS
# Last update Tue Apr  3 22:41:44 2001 François-Xavier BOIS
# 
##############################
# Complete this to make it ! #
##############################
NAME 	= chg_owner		
SRC	= chg_owner.c		
INCL  	=		
################
# Optional add #
################
IPATH   = -I.           
OBJOPT  = -g2           
EXEOPT  = -g2           
LPATH   = -L.           

#####################
# Macro Definitions #
#####################
CC 	= cc
MAKE 	= make
SHELL	= /bin/sh
OBJS 	= $(SRC:.c=.o) 
RM 	= /bin/rm -f 	
COMP	= gzip -9v
UNCOMP	= gzip -df
STRIP	= strip

CFLAGS  = $(OBJOPT) $(IPATH)
LDFLAGS = $(EXEOPT) $(LPATH)

.SUFFIXES: .h.Z .c.Z .h.gz .c.gz .c.z .h.z 

##############################
# Basic Compile Instructions #
##############################

$(NAME): $(OBJS) $(SRC) $(INCL)  
	$(CC) $(OBJS) $(LDFLAGS) -o $(NAME) 
#	$(STRIP) ./$(NAME) # if you debug ,don't strip ...

depend:
	gcc $(IPATH) -MM $(SRC) 
clean:
	-$(RM) $(NAME) $(OBJS) *~
comp: clean
	$(COMP) $(INCL) $(SRC)
ucomp: 
	$(UNCOMP) $(SRC) $(INCL)

.c.Z.c .h.Z.h .c.gz.c .h.gz.h .c.z.c .h.z.h :
	 -$(UNCOMP) $<

.c.o:
	$(CC) $(CFLAGS) -c $< 
################
# Dependencies #
################



